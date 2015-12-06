<?php
/**
 * 角色模型
 * @author simon <emali:1052214395@qq.com>
 * @time 2015.12.1
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class Role extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'role';

    public $timestamps = false;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['role_id'];

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'role_id';

    /**
     * 关联Role模型
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function roleGroup()
    {
        return $this->belongsTo('App\Models\AuthGroup', 'auth_group', 'group_label');
    }

    /**
     * 操作ROLE参数验证
     *
     * @return object.
     */
    public function operationValidation()
    {
        $rules = [
            'role_name' => 'required|between:2,20',
        ];
        $message = array(
            "required" => ":attribute,不能为空",
            "between"  => ":attribute,长度必须在 :min 和 :max 之间",
        );
        $attributes = array(
            'role_name' => '用户名',
        );
        $validator = Validator::make(
            Input::all(),
            $rules,
            $message,
            $attributes
        );
        return $validator;
    }

    /**
     * 获取角色权限组和权限列表
     * @param $role_id
     * @return mixed
     */
    public static function getUserAuthList($role_id)
    {
        $authGroup = Role::with('roleGroup')->where('role_id','=',$role_id)->first();
        $authList = AuthGroupRelaionship::getAuthGroupRelationshipByGroupLabel($authGroup->roleGroup->group_label);
        $data['authGroup'] = $authGroup->roleGroup;
        $data['authList'] = $authList;
        return $data;
    }
}
