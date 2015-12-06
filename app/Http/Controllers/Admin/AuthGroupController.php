<?php
/**
 * 权限组管理
 * @author simon <emali:1052214395@qq.com>
 * @time 2015.12.3
 */
namespace App\Http\Controllers\Admin;

use App\Models\Auth;
use App\Models\AuthGroup;
use App\Models\AuthGroupRelaionship;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class AuthGroupController extends Controller
{
    public function __construct()
    {
        $data = (Object)['Top'=>'QXZX','Left'=>'QXZ'];
        session(['nav' => $data]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($result = check_auth_to('QXZ_INDEX')) return $result;
        $site = Config::get('site');
        $data['authGroupList'] = AuthGroup::paginate($site['page_size']);
        return view('admin.auth_group.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($result = check_auth_to('QXZ_ADD')) return $result;
        $authObj = new Auth();
        $data['authList'] = $authObj->getAuthList();
        return view('admin.auth_group.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $authObj = new AuthGroup();
        $data = $request->all();
        $validator = $authObj->operationValidation();
        unset($data['_token']);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages())->with($data);
        }

        try {
            DB::transaction(function () use($data){
                AuthGroupRelaionship::saveAddAuthGroupRelationship($data['group_label'], $data['auth']);
                AuthGroup::create($data);
            });

            return redirect()->action('Admin\AuthGroupController@index')->with(array(
                'dialog' => array(
                    'title' => '增加权限组成功',
                    'message' => $data
                ),
            ));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '增加权限组失败, 请重试'])->with($data);
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
        if($result = check_auth_to('QXZ_EDIT')) return $result;
        $authObj = new Auth();
        $data['authList'] = $authObj->getAuthList();
        $data['authGroupInfo'] = AuthGroup::find($id);
        $data['selectAuth'] = AuthGroupRelaionship::getAuthGroupRelationshipByGroupLabel($id);
        foreach($data['authList'] as &$item)
        {
            foreach($item as &$val)
            {
                $val->selected = in_array($val->auth_label,$data['selectAuth'])?true:false;
            }
        }
        return view('admin.auth_group.edit', $data);
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
        $authObj = new AuthGroup();
        $data = $request->all();
        $validator = $authObj->operationValidation();
        unset($data['_token']);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages())->with($data);
        }

        try {
            DB::transaction(function () use($id,$data){
                AuthGroupRelaionship::deleteAuthGroupRelationshipGroupLabel($id);
                AuthGroupRelaionship::saveAddAuthGroupRelationship($data['group_label'], $data['auth']);
                AuthGroup::find($id)->update($data);
            });
            return redirect()->action('Admin\AuthGroupController@index')->with(array(
                'dialog' => array(
                    'title' => '修改权限组成功',
                    'message' => $data
                ),
            ));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '修改权限组失败, 请重试'])->with($data);
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
        if($result = check_auth_to('QXZ_DELETE')) return $result;
        try {
            DB::transaction(function () use($id){
                AuthGroupRelaionship::deleteAuthGroupRelationshipGroupLabel($id);
                AuthGroup::destroy($id);
            });
            return redirect()->action('Admin\AuthGroupController@index')->with('operationstatus', 'sucess');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '删除权限组失败,请重试(' . $e->getMessage() . ')']);
        }
    }
}
