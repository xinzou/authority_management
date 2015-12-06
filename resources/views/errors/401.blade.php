<!DOCTYPE html>
<html>
<head>
    <title>401 No authority</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="{{ asset('assets/admin/js/jquery-2.0.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" media="screen" href="{{ asset('assets/admin/css/bootstrap.min.css') }}">

    <link rel="stylesheet" media="screen" href="{{ asset('assets/admin/css/bootstrap-admin-theme.css') }}">
</head>
@include('pjax::pjax')

<body>
    <h1 style="width: 100%;text-align: center;">401 No authority</h1>

    <div style="width: 100%;text-align: center;margin-top: 150px;">
        <a href="{{URL::previous()}}?callback={{Input::get('callback','')}}" class="btn btn-grey">
            <i class="icon-arrow-left"></i>
            Go Back
        </a>
        <div width="100px"></div>
        <a href="{{URL::action(Session::get('loginUser')->auth['authGroup']->default_path)}}" class="btn btn-primary">
            <i class="icon-dashboard"></i>
            用户首页
        </a>
    </div>

    <div style="position: absolute; bottom: 0;padding: 10px 0;width: 100%;">
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
    </div>
</body>
</html>
