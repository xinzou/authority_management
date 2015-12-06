<?php
/**
 * 权限组模型
 * @author simon <emali:1052214395@qq.com>
 * @time 2015.12.1
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AuthGroup extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'auth_group';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['group_label','group_name','default_path'];
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'group_label';

    /**
     * 操作AUTH_GROUP参数验证
     *
     * @return object.
     */
    public function operationValidation()
    {
        $rules = [
            'group_label' => 'required|between:2,20',
            'group_name' => 'required|between:2,20',
            'default_path' => 'required|between:2,80',
        ];
        $message = array(
            "required" => ":attribute,不能为空",
            "between"  => ":attribute,长度必须在 :min 和 :max 之间",
        );
        $attributes = array(
            'group_name' => '权限组名',
            'group_label'=> '权限组标签',
            'default_path' => '默认地址'
        );
        $validator = Validator::make(
            Input::all(),
            $rules,
            $message,
            $attributes
        );
        return $validator;
    }
}
