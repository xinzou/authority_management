<?php
/**
 * 权限信息模型
 * @author simon <emali:1052214395@qq.com>
 * @time 2015.12.1
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class Auth extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'auth';

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
    protected $fillable = ['auth_label','auth_name','auth_type'];
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'auth_label';

    /**
     * 操作AUTH参数验证
     *
     * @return object.
     */
    public function operationValidation()
    {
        $rules = [
            'auth_label' => 'required|between:2,40',
            'auth_name' => 'required|between:2,20',
        ];
        $message = array(
            "required" => ":attribute,不能为空",
            "between"  => ":attribute,长度必须在 :min 和 :max 之间",
        );
        $attributes = array(
            'auth_name' => '用户名',
            'auth_label'=> '权限标签'
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
     * 获取所有Auth并按auth_type为KEY返回.
     *
     * @return array
     */
    public function getAuthList()
    {
        $result = array();
        $auth = DB::table($this->table)
            ->select('auth_label','auth_name','auth_type')
            ->get();
        if (!empty($auth)) {
            foreach ($auth as $value) {
                $result[$value->auth_type][] = $value;
            }
        }
        return $result;
    }
}
