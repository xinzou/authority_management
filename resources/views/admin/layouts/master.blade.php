<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap Docs -->
    <link href="{{ asset('assets/admin/css/docs.min.css') }}" rel="stylesheet" media="screen">

    <!-- Bootstrap -->
    <link rel="stylesheet" media="screen" href="{{ asset('assets/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" media="screen" href="{{ asset('assets/admin/css/bootstrap-theme.min.css') }}">

    <!-- Bootstrap Admin Theme -->
    <link rel="stylesheet" media="screen" href="{{ asset('assets/admin/css/bootstrap-admin-theme.css') }}">
    <link rel="stylesheet" media="screen" href="{{ asset('assets/admin/css/bootstrap-admin-theme-change-size.css') }}">

    <!-- Datatables -->
    <link rel="stylesheet" media="screen" href="{{ asset('assets/admin/css/DT_bootstrap.css') }}">
    <script type="text/javascript" src="{{ asset('assets/admin/js/jquery-2.0.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>
    <!-- Custom styles -->
    <style type="text/css">
        @font-face {
            font-family: Ubuntu;
            src: url('fonts/Ubuntu-Regular.ttf');
        }

        .bs-docs-masthead {
            background-color: #6f5499;
            background-image: linear-gradient(to bottom, #563d7c 0px, #6f5499 100%);
            background-repeat: repeat-x;
        }

        .bs-docs-masthead {
            padding: 0;
        }

        .bs-docs-masthead h1 {
            color: #fff;
            font-size: 40px;
            margin: 0;
            padding: 34px 0;
            text-align: center;
        }

        .bs-docs-masthead a:hover {
            text-decoration: none;
        }

        .meritoo-logo a {
            background-color: #fff;
            border: 1px solid rgba(66, 139, 202, 0.4);
            display: block;
            font-family: Ubuntu;
            padding: 22px 0;
            text-align: center;
        }

        .meritoo-logo a,
        .meritoo-logo a:hover,
        .meritoo-logo a:focus {
            text-decoration: none;
        }

        .meritoo-logo a img {
            display: block;
            margin: 0 auto;
        }

        .meritoo-logo a span {
            color: #4e4b4b;
            font-size: 18px;
        }

        .row-urls {
            margin-top: 4px;
        }

        .row-urls .col-md-6 {
            text-align: center;
        }

        .row-urls .col-md-6 a {
            font-size: 14px;
        }
    </style>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="js/html5shiv.js"></script>
    <script type="text/javascript" src="js/respond.min.js"></script>
    <![endif]-->
</head>
@include('pjax::pjax')

<body class="bootstrap-admin-with-small-navbar">
<!-- small navbar -->
<nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar-sm" role="navigation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left bootstrap-admin-theme-change-size">
                        <li class="text">Change size:</li>
                        <li><a class="size-changer small">Small</a></li>
                        <li><a class="size-changer large active">Large</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" role="button" class="dropdown-toggle" data-hover="dropdown"> <i
                                        class="glyphicon glyphicon-user"></i>{{Session::get('loginUser')->username}}<i
                                        class="caret"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{URL::action('Admin\UserController@getEditPassword')}}">密码修改</a></li>
                                <li>
                                    <a href="{{URL::action('Admin\LoginController@login','callback='.base64_encode(Request::getRequestUri()))}}">刷新权限</a>
                                </li>
                                <li role="presentation" class="divider"></li>
                                <li><a href="{{URL::action('Admin\LoginController@logout')}}">退出</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- main / large navbar -->
<nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar bootstrap-admin-navbar-under-small"
     role="navigation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".main-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand"
                       href="{{URL::action(Session::get('loginUser')->auth['authGroup']->default_path)}}">后台管理系统</a>
                </div>
                <div class="collapse navbar-collapse main-navbar-collapse">
                    <ul class="nav navbar-nav">
                        @if(check_auth('QXZX'))
                            <li @if(Session::get('nav')->Top === 'QXZX')class="active"@endif><a
                                        href="{{ URL::route('user.index')}}">权限中心</a></li>
                        @endif
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </div>
    </div><!-- /.container -->
</nav>

@yield('content')

        <!-- footer -->
<div class="navbar navbar-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <footer role="contentinfo">
                    <p class="left">管理系统v1.0</p>

                    <p class="right">&copy; 2015 <a href="http://www.turnreal.net" target="_blank">Turneal</a></p>
                </footer>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ asset('assets/admin/js/twitter-bootstrap-hover-dropdown.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/admin/js/bootstrap-admin-theme-change-size.js') }}"></script>
<!--<script type="text/javascript" src="{{ asset('assets/admin/vendors/datatables/js/jquery.dataTables.js') }}"></script>-->
<!--<script type="text/javascript" src="{{ asset('assets/admin/js/DT_bootstrap.js') }}"></script>-->
</body>
</html>
