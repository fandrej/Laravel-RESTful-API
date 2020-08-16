<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserController extends Controller
{
    private function secure($user_data)
    {
        // генерируется всегда новый
        $user_data['api_token'] = Str::random(60);
        // меняется только если есть
        if( isset($user_data['password']) )
            $user_data['password'] = bcrypt($user_data['password']);

        return $user_data;
    }

    // Получение списка Пользователей
    // GET /api/users?api_token=AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42
    public function index(Request $request)
    {
        // токены может видеть только админ (в данном случае - никто), пароли - никто
        // юзеры могут видеть юзеров только своего юрлица
        $query = "SELECT u.id, name, fio, email, phone, created_at
                    FROM users u
                    WHERE u.id IN (SELECT users_id
                					FROM userfirms
                					WHERE firms_id = (SELECT firms_id
            											FROM userfirms
            											WHERE users_id = ?))";

        $item = DB::select($query, [$request->user()->id]);
        return $item;
    }

    // Получение информации о конкретном пользователе
    // GET /api/users/{user_id}?api_token=AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42
    public function show(Request $request, $user_id=0)
    {
        if( !$user_id ) // о себе
            return $request->user();    // можно видеть всё
        else {
            // токены может видеть только админ (в данном случае - никто), пароли - никто
            // юзеры могут видеть юзеров только своего юрлица
            $query = "SELECT u.id, NAME, fio, email, phone, created_at
                        FROM users u
                        WHERE u.id = :about_user
                        	AND u.id IN (SELECT users_id
                        					FROM userfirms
                        					WHERE firms_id = (SELECT firms_id
                    											FROM userfirms
                    											WHERE users_id = :request_user))";

            $item = DB::select($query, ['about_user' => $user_id, 'request_user' => $request->user()->id]);
            if( $item )
                return $item;
            else
                abort(404);
        }
    }

    // Создание пользователя
    // POST /api/users?api_token=AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42
    public function store(Request $request)
    {
        // пароль новому пользователю заздаёт создающий
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'fio' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $data = $this->secure($request->all());
        if( isset($data['is_admin']) )
            unset($data['is_admin']);

        $user = User::create($data);
        if( $user ){
            // Новый пользователь должен принадлежать тому же юрлицу, что и создавший его
            $query = "SELECT firms_id FROM userfirms WHERE users_id = ?";
            $item = DB::select($query, [$request->user()->id]);
            DB::insert('insert into userfirms (firms_id, users_id) values (?, ?)', [$item[0]->firms_id, $user->id]);
        }

        return $user;
    }

    // Изменение пользователя
    // PUT/PATCH /api/users/{user_id}?api_token=AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42
    public function update(Request $request, $user_id=0)
    {
        if( $user_id != $request->user()->id ) {   // не себя
            // юзеры могут видеть/изменять юзеров только своего юрлица
            $query = "SELECT u.id
                        FROM users u
                        WHERE u.id = :about_user
                        	AND u.id IN (SELECT users_id
                        					FROM userfirms
                        					WHERE firms_id = (SELECT firms_id
                    											FROM userfirms
                    											WHERE users_id = :request_user))";

            $item = DB::select($query, ['about_user' => $user_id, 'request_user' => $request->user()->id]);
            if( $item )
                $item = User::find($user_id);
        }
        else    // себя
            $item = User::find($request->user()->id);

        // пароль менять можно, юрлицо нет
        // api_token перегенерируется

        if( $item ) {
            $user_data = $request->all();

            // проверка значений, могут быть переданы не все (PATCH)
            $validate_values = [];

            if( isset($user_data['name']) )
                $validate_values['name'] = ['required', 'string', 'max:50'];

            if( isset($user_data['fio']) )
                $validate_values['fio'] = ['required', 'string', 'max:100'];

            if( isset($user_data['email']) )
                $validate_values['email'] = ['required', 'string', 'email', 'max:255'];

            if( isset($user_data['password']) )
                $validate_values['password'] = ['required', 'string', 'min:8'];

            $request->validate($validate_values);
            // строго говоря, пару name:password надо ещё проверять на уникальность, но фиг с ним

            if( isset($user_data['created_at']) )
                unset($user_data['created_at']);

            if( isset($user_data['updated_at']) )
                unset($user_data['updated_at']);

            if( isset($user_data['is_admin']) )
                unset($user_data['is_admin']);

            $data = $this->secure($user_data);
            $item->update($data);
        }
        else
            abort(404);

        return $item;
    }

    // Удаление пользователя
    // DELETE /api/users/{user_id}?api_token=AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42
    public function delete(Request $request, $user_id)
    {
        if( $request->user()->id == $user_id )
            $item = $request->user();
        else {
            // юзеры могут удалять юзеров только своего юрлица
            $query = "SELECT u.id
                        FROM users u
                        WHERE u.id = :about_user
                        	AND u.id IN (SELECT users_id
                        					FROM userfirms
                        					WHERE firms_id = (SELECT firms_id
                    											FROM userfirms
                    											WHERE users_id = :request_user))";

            $item = DB::select($query, ['about_user' => $user_id, 'request_user' => $request->user()->id]);
            if( $item )
                $item = User::find($user_id);
        }

        if( $item )
            $item->delete();
        else
            abort(404);

        return 204;
    }
}
