<?php
/**
 * 角色管理
 * @author simon <emali:1052214395@qq.com>
 * @time 2015.12.2
 */
namespace App\Http\Controllers\Admin;

use App\Models\AuthGroup;
use App\Models\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class RoleController extends Controller
{
    public function __construct()
    {
        $data = (Object)['Top'=>'QXZX','Left'=>'JSLB'];
        session(['nav' => $data]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($result = check_auth_to('JSLB_INDEX')) return $result;
        $site = Config::get('site');
        $data['roleList'] = Role::with('roleGroup')->paginate($site['page_size']);
        return view('admin.role.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($result = check_auth_to('JSLB_ADD')) return $result;
        $data['authGroupList'] = AuthGroup::all();
        return view('admin.role.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $roleObj = new Role();
        $data = $request->all();
        $validator = $roleObj->operationValidation();
        unset($data['_token']);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages())->with($data);
        }

        try {

            Role::create($data);
            return redirect()->action('Admin\RoleController@index')->with(array (
                'dialog' => array (
                    'title' => '增加角色成功',
                    'message' => $data
                ),
            ));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '增加角色失败, 请重试'])->with($data);
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
        $data['roleInfo'] = Role::find($id);
        return view('admin.role.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($result = check_auth_to('JSLB_EDIT')) return $result;
        $data['authGroupList'] = AuthGroup::all();
        $data['roleInfo'] = Role::find($id);
        return view('admin.role.edit', $data);
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
        $roleObj = new Role();
        $data = $request->all();
        $validator = $roleObj->operationValidation();
        unset($data['_token']);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages())->with($data);
        }

        try{
            Role::find($id)->update($data);
            return redirect()->action('Admin\RoleController@index')->with(array (
                'dialog' => array (
                    'title' => '修改角色成功',
                    'message' => $data
                ),
            ));
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => '修改角色失败, 请重试'])->with($data);
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
        if($result = check_auth_to('JSLB_DELETE')) return $result;
        try {
            Role::destroy($id);
            return redirect()->action('Admin\RoleController@index')->with('operationstatus', 'sucess');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '删除角色失败,请重试('.$e->getMessage().')']);
        }
    }
}
