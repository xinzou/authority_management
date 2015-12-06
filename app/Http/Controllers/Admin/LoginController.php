<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.login');
    }

    /**
     * Post login credentials
     *
     * @return Response
     */
    public function login()
    {
        $userObj = new User();
        $data = Input::all();
        unset($data['_token']);
        $username = isset($data['username']) ? $data['username'] : null;
        $password = isset($data['password']) ? $data['password'] : null;
        $remember = isset($data['remember']) ? $data['remember'] : null;
        $salt = $userObj->getSalt($username);
        if(!$salt)
        {
            return redirect()->back()->withErrors(['error' => '用户不存在，请重新输入！'])->with($data);
        }

        if(Auth::attempt(['username' => $username, 'password' => $password.$salt], $remember))
        {
            $user = Auth::user();
            $user->auth = Role::getUserAuthList($user->role_id);
            session(['loginUser' => $user]);
            if (Input::has('callback')) {
                return redirect(base64_decode(Input::get('callback')));
            }
            return redirect()->action($user->auth['authGroup']->default_path);
        }
        return redirect()->back()->withErrors(['error' => '用户名或密码错误，请重新输入！'])->with($data);
    }

    /**
     * Log out
     *
     * @return Response
     */
    public function logout()
    {
        Auth::logout();
        return view('admin.login');
    }

    public function noAuthority()
    {
        return view('errors.401');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
