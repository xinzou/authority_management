<?php
/**
 * 用户管理.
 * @author simon <email:1052214395@qq.com>
 * @time 2015.12.1
 */
namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['user_id','updated_at','created_at'];
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * 关联Role模型
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userRole()
    {
        return $this->belongsTo('App\Models\Role', 'role_id', 'role_id');
    }

    /**
     * 操作USER参数验证
     *
     * @return object.
     */
    public function operationValidation()
    {
        $rules = [
            'email'         => 'required|email|email',
            'username' => 'required|between:2,20',
            'truename' => 'required|between:2,20',
            'mobile' => ['required','regex:/^0{0,1}(13|15|17|18)[0-9]{9}$/i']
        ];
        $message = array(
            "required" => ":attribute,不能为空",
            "between"  => ":attribute,长度必须在 :min 和 :max 之间",
            'email' => ":attribute,验证不合法",
        );
        $attributes = array(
            'username' => '用户名',
            'mobile' => '移动号码',
            'truename' => '姓名',
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
     * 制造Salt.
     *
     * @return string Salt.
     */
    public function generateSalt()
    {
        $site = Config::get('site');
        $randString = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $salt = '';
        for ($i = 0; $i < $site['salt_length']; $i++) {
            $salt = $salt.$randString[rand(0, 61)];
        }
        return $salt;
    }

    /**
     * 获取用户salt
     * @param $username
     * @return string
     */
    public function getSalt($username)
    {
        $result = DB::select("select salt from ".$this->table." where username=:username limit 1",['username' => $username]);
        if($result)
        {
            return $result[0]->salt;
        }
        return false;
    }
}
