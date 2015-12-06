<?php
/**
 * 用户管理
 * @author simon <emali:1052214395@qq.com>
 * @time 2015.12.1
 */
namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    private $defaultPassword = '123456';

    public function __construct()
    {
        $data = (Object)['Top'=>'QXZX','Left'=>'YHLB'];
        session(['nav' => $data]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $site = Config::get('site');
        if($result = check_auth_to('YHLB_INDEX')) return $result;
        $data['userList'] = User::with('userRole')->paginate($site['page_size']);
        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($result = check_auth_to('YHLB_ADD')) return $result;
        $data['roleList'] = Role::all();
        return view('admin.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userObj = new User();
        $data = $request->all();
        $validator = $userObj->operationValidation();
        unset($data['_token']);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages())->with($data);
        }

        $data['salt'] = $userObj->generateSalt();
        $data['password'] = bcrypt($this->defaultPassword.$data['salt']);

        try {
            User::create($data);
            return redirect()->action('Admin\UserController@index')->with(array (
                'dialog' => array (
                    'title' => '增加用户成功',
                    'message' => $data
                ),
            ));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '增加用户失败, 请重试'])->with($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['userInfo'] = User::find($id);
        return view('admin.user.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($result = check_auth_to('YHLB_EDIT')) return $result;
        $data['roleList'] = Role::all();
        $data['userInfo'] = User::find($id);
        return view('admin.user.edit', $data);
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
        $userObj = new User();
        $data = $request->all();
        $validator = $userObj->operationValidation();
        unset($data['_token']);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages())->with($data);
        }

        try{
            User::find($id)->update($data);
            return redirect()->action('Admin\UserController@index')->with(array (
                'dialog' => array (
                    'title' => '修改用户成功',
                    'message' => $data
                ),
            ));
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => '修改用户失败, 请重试'])->with($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($result = check_auth_to('YHLB_DELETE')) return $result;
        try {
            User::destroy($id);
            return redirect()->action('Admin\UserController@index')->with('operationstatus', 'sucess');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '删除用户失败,请重试('.$e->getMessage().')']);
        }
    }

    /**
     * 返回修改密码页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditPassword()
    {
        return view('admin.user.edit_password');
    }

    /**
     * 修改密码保存
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postEditPassword($id)
    {
        $data = Input::all();
        unset($data['_token']);

        $user = session('loginUser');
        $salt = $user->salt;

        if(!Auth::attempt(['username' => $user->username, 'password' => $data['old_password'].$salt]))
        {
            return redirect()->back()->withErrors(['error' => '旧密码验证有误, 请重试'])->with($data);
        }
        unset($data['old_password']);
        $data['password'] = bcrypt($data['password'].$salt);
        try{
            User::find($id)->update($data);
            return redirect()->action('Admin\UserController@getEditPassword')->with('operationstatus', 'sucess');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => '修改密码失败, 请重试'.$e->getMessage()])->with($data);
        }
    }
}
