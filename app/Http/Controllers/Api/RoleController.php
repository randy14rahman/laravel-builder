<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Zend\Debug\Debug;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // Debug::dump($request->input());die;

        $data = app('db')->connection()->select("SELECT
                r.id,
                r.name,
                rl.level
            from
                roles r
            left join role_level rl on
                r.id = rl.role_id
            where r.name!='Super Admin'");
        // Debug::dump($result);die;


        $result = ['status'=>1, 'data' => $data];

        return response()->json($result);
    }

    public function addRole(Request $request) {
        // Debug::dump($request->input());die;

        $role_id = app('db')->connection()->table('roles')-> insertGetId(array(
            'name' => $request->input('name'),
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s')
        ));

        $level = (int) $request->input('level');
        app('db')->connection()->insert("INSERT INTO role_level (role_id, level, created_at) VALUES(:role_id, :level, now())", ['role_id'=> $role_id,'level'=>$level]);
        return response()->json(['status'=>1]);
    }

    public function editRole(Request $request, $role_id) {
        // Debug::dump($request->input());die;

        $role_id = (int) $request->input('id');
        $level = (int) $request->input('level', 0);

        $hasLevel = app('db')->connection()->select('SELECT level from role_level where role_id=:role_id', ['role_id'=>$role_id]);

        (count($hasLevel)==0)
            ?  app('db')->connection()->insert('INSERT INTO role_level (role_id, level, created_at) VALUES (:role_id, :level, now())', [
                'role_id' => $role_id,
                'level' => $level
            ])
            : app('db')->connection()->update("UPDATE role_level set level=:level, updated_at=now() where role_id=:role_id", [
                'role_id' => $role_id,
                'level' => $level
            ]);

        $params = [
            'role_id' => $role_id,
            'name'  => $request->input('name'),
        ];

        app('db')->connection()->insert("UPDATE roles set name=:name, updated_at=now() where id=:role_id", $params);
        return response()->json(['status'=>1]);
    }

    public function deleteRole(Request $request, $role_id) {
        // Debug::dump($request->input());die;

        $role_id = (int) $role_id;

        $params = [
            'role_id' => $role_id
        ];
        // Debug::dump($params);die;

        app('db')->connection()->table('roles')->where('id', $role_id)->delete();
        app('db')->connection()->table('role_level')->where('role_id', $role_id)->delete();
        return response()->json(['status'=>1]);
    }


}