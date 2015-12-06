<?php
/**
 * 权限信息管理
 * @author simon <emali:1052214395@qq.com>
 * @time 2015.12.3
 */
namespace App\Http\Controllers\Admin;

use App\Models\Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class AuthController extends Controller
{
    public function __construct()
    {
        $data = (Object)['Top'=>'QXZX','Left'=>'QXXX'];
        session(['nav' => $data]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($result = check_auth_to('QXXX_INDEX')) return $result;
        $site = Config::get('site');
        $data['authList'] = Auth::paginate($site['page_size']);
        return view('admin.auth.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($result = check_auth_to('QXXX_ADD')) return $result;
        $site = Config::get('site');
        $data['auth_type'] = $site['auth_type'];
        return view('admin.auth.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $authObj = new Auth();
        $data = $request->all();
        $validator = $authObj->operationValidation();
        unset($data['_token']);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages())->with($data);
        }

        try {
            Auth::create($data);
            return redirect()->action('Admin\AuthController@index')->with(array(
                'dialog' => array(
                    'title' => '增加权限信息成功',
                    'message' => $data
                ),
            ));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '增加权限信息失败, 请重试'])->with($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($result = check_auth_to('QXXX_EDIT')) return $result;
        $site = Config::get('site');
        $data['auth_type'] = $site['auth_type'];
        $data['authInfo'] = Auth::find($id);
        return view('admin.auth.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $authObj = new Auth();
        $data = $request->all();
        $validator = $authObj->operationValidation();
        unset($data['_token']);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages())->with($data);
        }

        try {
            Auth::find($id)->update($data);
            return redirect()->action('Admin\AuthController@index')->with(array(
                'dialog' => array(
                    'title' => '修改权限信息成功',
                    'message' => $data
                ),
            ));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '修改权限信息失败, 请重试'])->with($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($result = check_auth_to('QXXX_DELETE')) return $result;
        try {
            Auth::destroy($id);
            return redirect()->action('Admin\AuthController@index')->with('operationstatus', 'sucess');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '删除权限信息失败,请重试(' . $e->getMessage() . ')']);
        }
    }
}
