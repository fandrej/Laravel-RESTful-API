<?php
// https://laravel.su/docs/6.x/controllers

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Dep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepController extends Controller
{
    // Получение списка Подразделений
    // GET /api/deps?api_token=AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42
    public function index(Request $request)
    {
        // принадлежащих тому же Юридическому лицу, что и текущий Пользователь
        $query = "SELECT d.*
                    FROM deps d
                    WHERE d.id IN (SELECT deps_id
                					FROM firmdeps
                					WHERE firms_id = (SELECT firms_id
            											FROM userfirms
            											WHERE users_id = ?))";
        $item = DB::select($query, [$request->user()->id]);

        return $item;
    }

    // Получение информации о конкретном Подразделении
    // GET /api/deps/{dep_id}?api_token=AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42
    public function show(Request $request, $dep_id=0)
    {
        // принадлежащего тому же Юридическому лицу, что и текущий Пользователь
        $query = "SELECT d.*
                    FROM deps d
                    WHERE d.id = (SELECT deps_id
                					FROM firmdeps
                					WHERE deps_id = :about_dep
                						AND firms_id = (SELECT firms_id
            											FROM userfirms
            											WHERE users_id = :request_user))";

        $item = DB::select($query, ['about_dep' => $dep_id, 'request_user' => $request->user()->id]);
        if( $item )
            return $item;
        else
            abort(404);
    }

    // Создание Подразделения
    // POST /api/deps?api_token=AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:300'],
            'type' => ['required', 'string', 'max:255'],
        ]);

        $data = $request->all();

        if( !in_array($data['type'], ['Кафе', 'Офис']) )
            abort(400, 'type must by Кафе or Офис');

        $dep = Dep::create($data);
        if( $dep ){
            // Новое подразделение должно принадлежать тому же юрлицу, что и создавший его
            $query = "SELECT firms_id FROM userfirms WHERE users_id = ?";
            $item = DB::select($query, [$request->user()->id]);
            DB::insert('insert into firmdeps (firms_id, deps_id) values (?, ?)', [$item[0]->firms_id, $dep->id]);
        }

        return $dep;
    }

    // Изменение подразделения
    // PUT/PATCH /api/deps/{dep_id}?api_token=AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42
    public function update(Request $request, $dep_id=0)
    {
        // принадлежащего тому же Юридическому лицу, что и текущий Пользователь
        // принадлежащего тому же Юридическому лицу, что и текущий Пользователь
        $query = "SELECT d.*
                    FROM deps d
                    WHERE d.id = (SELECT deps_id
                					FROM firmdeps
                					WHERE deps_id = :about_dep
                						AND firms_id = (SELECT firms_id
            											FROM userfirms
            											WHERE users_id = :request_user))";

        $item = DB::select($query, ['about_dep' => $dep_id, 'request_user' => $request->user()->id]);
        if( $item )
            $item = Dep::find($dep_id);

        if( $item ){
            // проверка значений, могут быть переданы не все (PATCH)
            $validate_values = [];
            $data = $request->all();

            if( isset($data['name']) )
                $validate_values['name'] = ['required', 'string', 'max:300'];

            if( isset($data['address']) )
                $validate_values['address'] = ['required', 'string', 'max:100'];

            $request->validate($validate_values);

            if( isset($data['type']) && !in_array($data['type'], ['Кафе', 'Офис']) )
                abort(400, 'type must by Кафе or Офис');

            $item->update($request->all());
        }
        else
            abort(404);

        return $item;
    }

    // Удаление подразделения
    // DELETE /api/deps/{dep_id}?api_token=AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42
    public function delete(Request $request, $dep_id)
    {
        // принадлежащего тому же Юридическому лицу, что и текущий Пользователь
        $query = "SELECT d.*
                    FROM deps d
                    WHERE d.id = (SELECT deps_id
                					FROM firmdeps
                					WHERE deps_id = :about_dep
                						AND firms_id = (SELECT firms_id
            											FROM userfirms
            											WHERE users_id = :request_user))";

        $item = DB::select($query, ['about_dep' => $dep_id, 'request_user' => $request->user()->id]);
        if( $item )
            $item = Dep::find($dep_id);

        if( $item )
            $item->delete();
        else
            abort(404);

        return 204;
    }

    // Получение информации о Юридическом лице конкретного Подразделения
    // GET /api/deps/{dep_id}/firma
    public function firma($dep_id)
    {
        // публичный метод
        $item = DB::select('SELECT * FROM firms WHERE id = (select firms_id FROM firmdeps WHERE deps_id=?)', [$dep_id]);

        if( $item )
            return $item;
        else
            abort(404);
    }

    // Получение списка Городов Подразделений, принадлежащих тому же Юридическому лицу, что и текущий Пользователь
    // GET /api/deps/towns?api_token=AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42
    public function towns(Request $request)
    {
        $query = "WITH a AS (
                    	SELECT firms_id FROM userfirms WHERE users_id = ?
                    ),
                    b AS (
                    	SELECT deps_id FROM firmdeps WHERE firms_id = (SELECT firms_id FROM a)
                    ),
                    c AS (
                    	SELECT deps_id, towns_id FROM deptowns WHERE deps_id IN (SELECT deps_id FROM b)
                    )
                    SELECT t.name AS town, d.name AS dep, d.type
                    FROM c
                    LEFT JOIN deps d ON d.id = c.deps_id
                    LEFT JOIN towns t ON t.id = c.towns_id
                    ORDER BY 1";
        $item = DB::select($query, [$request->user()->id]);

        if( $item )
            return $item;
        else
            abort(404);
    }
}
