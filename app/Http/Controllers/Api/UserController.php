<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Zend\Debug\Debug;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
        // Debug::dump($request->bearerToken());die;

        $sql = "SELECT
                u.id,
                u.username,
                u.name,
                u.email,
                mhr.role_id,
                r.name role_name,
                p.nip,
                p.jabatan,
                p.is_pemaraf,
                p.is_pettd 
            from
                users u
            left join person p on
                    u.id = p.user_id
            left join model_has_roles mhr on
                u.id = mhr.model_id
            left join roles r on
                mhr.role_id = r.id";

        // Debug::dump($sql);die;
        $data = app('db')->connection()->select($sql, []);
        // Debug::dump($data);die;

        $result = ['data' => $data];

        return response()->json($result);
    }

    public function addUser(Request $request)
    {
        // Debug::dump($request->input());die;

        $validated = $request->validate([
            'nip' => 'required|min:18|max:18',
            'email' => 'email'
        ]);

        // Debug::dump($validated);die;

        $user_id = (int)$request->input('id') ?? 0;
        // Debug::dump($request->input());die;

        $data = [
            'username' => $request->input('username')??$request->input('nip'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        // Debug::dump($data);die;

        $result = User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $userInfo = $result->getOriginal();
        // Debug::dump($userInfo['id']);die;

        $user_id = (int) $userInfo['id'];

        // delete roles by user_id
        app('db')->connection()->table('model_has_roles')->where('model_id', $user_id)->delete();

        // insert roles to user_id
        $params = [
            'role_id' => (int) $request->input('role', 0),
            'user_id' => $user_id
        ];

        app('db')->connection()->insert("INSERT INTO model_has_roles (role_id, model_type, model_id) VALUES(:role_id, 'App\Models\User', :user_id)", $params);

        // insert info user to person table
        $params = [
            'user_id'   => (int) $userInfo['id'],
            'nip'       => (int) $request->input('nip'),
            'jabatan'       => $request->input('jabatan'),
            'is_pemaraf'       => (int) ($request->input('is_pemaraf') ?? 0) == 1 ? 1 : 0,
            'is_pettd'       => (int) ($request->input('is_pettd') ?? 0) == 1 ? 1 : 0,
        ];

        $result = app('db')->connection()->insert("INSERT into person (user_id, nip, jabatan, is_pemaraf, is_pettd) VALUES(:user_id, :nip, :jabatan, :is_pemaraf, :is_pettd)", $params);

        // Debug::dump($result);die;

        return response()->json([
            'status' => 1,
            'data' => $userInfo,
        ], 200);
    }

    public function editUser(Request $request, $user_id)
    {

        $user_id = (int) $user_id;
        // Debug::dump($user_id);die;

        // delete roles by user_id
        app('db')->connection()->table('model_has_roles')->where('model_id', $user_id)->delete();

        // insert roles to user_id
        $params = [
            'role_id' => (int) $request->input('role', 0),
            'user_id' => $user_id
        ];

        app('db')->connection()->insert("INSERT INTO model_has_roles (role_id, model_type, model_id) VALUES(:role_id, 'App\Models\User', :user_id)", $params);


        // update users
        $params = [
            'user_id'   => $user_id,
            'name'      => $request->input('name'),
            'email'      => $request->input('email')
        ];

        $additional_set = "";
        if ($request->input('password') != '') {
            $params['password'] = Hash::make($request->input('password'));
            $additional_set .= ", password=:password";
        }

        // Debug::dump($params);die;

        app('db')->connection()->update(
            "UPDATE users set name=:name, email=:email, updated_at=now(){$additional_set} where id=:user_id",
            $params
        );
        // Debug::dump($result);die;

        // Debug::dump($params);die;

        $hasPerson = app('db')->connection()->select('SELECT id from person where user_id=:user_id', ['user_id'=>$user_id]);
        // Debug::dump($hasPerson);die;

        // update info user (person)
        $params = [
            'user_id' => $user_id,
            'nip'       => (int) $request->input('nip'),
            // 'role_id'       => (int) $request->input('role'),
            'jabatan'       => $request->input('jabatan'),
            'is_pemaraf'       => (int) ($request->input('is_pemaraf') ?? 0) == 1 ? 1 : 0,
            'is_pettd'       => (int) ($request->input('is_pettd') ?? 0) == 1 ? 1 : 0,
        ];

        (count($hasPerson)==0)
            ?  app('db')->connection()->insert(
                "INSERT INTO person (user_id, nip, jabatan, is_pemaraf, is_pettd) VALUES(:user_id, :nip, :jabatan, :is_pemaraf, :is_pettd)",
                $params
            ) 
            : app('db')->connection()->update(
                "UPDATE person set nip=:nip, jabatan=:jabatan, is_pemaraf=:is_pemaraf, is_pettd=:is_pettd where user_id=:user_id",
                $params
            );

        return response()->json([
            'status' => 1
        ]);
    }

    public function deleteUser(Request $request, $user_id)
    {
        $user_id = (int) $user_id;
        // Debug::dump($user_id);die;

        // delete roles by user_id
        app('db')->connection()->table('model_has_roles')->where('model_id', $user_id)->delete();
        // delete person
        app('db')->connection()->table('person')->where('user_id', $user_id)->delete();
        // delete users
        app('db')->connection()->table('users')->where('id', $user_id)->delete();

        return response()->json(['status' => 1]);
    }
}