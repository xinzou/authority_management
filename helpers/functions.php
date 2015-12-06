<?php
/**
 * User: Simon<email:1052214395@qq.com>
 * Time: 2015.03.18 下午4:08
 */
if (! function_exists('check_auth_to')) {
    /**
     * 检查是否具有权限并跳转
     * @param $authStr
     * @return \Illuminate\Http\RedirectResponse
     */
    function check_auth_to($authStr)
    {
        if(!check_auth($authStr))
        {
            return redirect()->action("Admin\LoginController@noAuthority",'callback='.base64_encode(Request::getRequestUri()));
        }
    }
}

if (! function_exists('check_auth')) {
    /**
     * 检查是否具有权限（模板使用）
     * @param $authStr
     * @return \Illuminate\Http\RedirectResponse
     */
    function check_auth($authStr)
    {
        if(check_admin())
        {
            return true;
        }

        if(in_array($authStr, session('loginUser')->auth['authList']))
        {

            return true;
        }
        return false;
    }
}

if (! function_exists('check_admin')) {
    /**
     * 检查是否是管理员
     * @param $authStr
     * @return \Illuminate\Http\RedirectResponse
     */
    function check_admin()
    {
        $site_config = config('site');
        $user = \Illuminate\Support\Facades\Auth::user();
        if($site_config['administrator'] === $user->username)
        {
            return true;
        }
        return false;
    }
}