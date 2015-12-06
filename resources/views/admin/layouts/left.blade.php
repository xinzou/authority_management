<div class="col-md-2 bootstrap-admin-col-left">
    <ul class="nav navbar-collapse collapse bootstrap-admin-navbar-side">
        <!--权限中心-->
        <li>
            <a href="{{ URL::route('role.index')}}"><i class="glyphicon glyphicon-chevron-down"></i> 角色管理</a>
            <ul class="nav navbar-collapse bootstrap-admin-navbar-side">
                @if(check_auth('JSLB_INDEX'))
                    <li @if(Session::get('nav')->Left === 'JSLB')class="active"@endif><a href="{{ URL::route('role.index')}}"><i class="glyphicon glyphicon-chevron-right"></i> 角色列表</a></li>
                @endif
                @if(check_auth('YHLB_INDEX'))
                    <li @if(Session::get('nav')->Left === 'YHLB')class="active"@endif><a href="{{ URL::route('user.index')}}"><i class="glyphicon glyphicon-chevron-right"></i> 用户列表</a></li>
                @endif
                @if(check_auth('QXXX_INDEX'))
                    <li @if(Session::get('nav')->Left === 'QXXX')class="active"@endif><a href="{{ URL::route('auth.index')}}"><i class="glyphicon glyphicon-chevron-right"></i> 权限信息</a></li>
                @endif
                @if(check_auth('QXZ_INDEX'))
                    <li @if(Session::get('nav')->Left === 'QXZ')class="active"@endif><a href="{{ URL::route('auth_group.index')}}"><i class="glyphicon glyphicon-chevron-right"></i> 权限组</a></li>
                @endif
            </ul>
        </li>
        <!--结尾Li-->
        </li>
    </ul>
</div>