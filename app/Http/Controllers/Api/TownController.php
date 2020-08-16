<?php
// https://laravel.su/docs/6.x/controllers

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Town;
use App\Dep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TownController extends Controller
{
    // Получение списка Городов
    // GET /api/towns
    public function index()
    {
        return Town::all();
    }

    // GET /api/towns/{town_id}
    public function show($town_id)
    {
        $item = Town::find($town_id);
        if( $item )
            return $item;
        else
            abort(404);
    }

    // POST /api/towns
    public function store(Request $request)
    {
        return Town::create($request->all());
    }

    // PUT/PATCH /api/towns/{town_id}
    public function update(Request $request, $town_id)
    {
        $item = Town::find($town_id);
        if( $item )
            $item->update($request->all());
        else
            abort(404);

        return $item;
    }

    // DELETE /api/towns/{town_id}
    public function delete($town_id)
    {
        $item = Town::find($town_id);
        if( $item )
            $item->delete();
        else
            abort(404);

        return 204;
    }

    // Получение списка Подразделений в конкретном Городе
    // GET /api/towns/{town_id}/deps
    public function deps($town_id)
    {
        $item = DB::select('SELECT * FROM deps WHERE EXISTS (select deps_id FROM deptowns WHERE deps_id = deps.id and towns_id=?)', [$town_id]);

        if( $item )
            return $item;
        else
            abort(404);
    }
}
