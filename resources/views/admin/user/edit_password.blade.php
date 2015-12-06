@extends('admin.layouts.master')
@section('title', '修改密码')
@section('content')
    <div class="container">
        <!-- left, vertical navbar & content -->
        <div class="row">
            @include('admin.layouts.left')
            <!-- left, vertical navbar -->
            <!-- content -->
            <div class="col-md-10">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                            <h1>修改密码</h1>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                <a class="close" data-dismiss="alert" href="#">&times;</a>
                                {{ $error }}
                            </div>
                        @endforeach
                        @if (Session::has('operationstatus') && Session::get('operationstatus') == 'sucess')
                            <div class="alert alert-success">
                                <a class="close" data-dismiss="alert" href="#">&times;</a>
                                <strong>Success!</strong> 修改密码成功.
                            </div>
                        @elseif (Session::has('operationstatus') && Session::get('operationstatus') == 'failure')
                            <div class="alert alert-danger">
                                <a class="close" data-dismiss="alert" href="#">&times;</a>
                                <strong>Success!</strong> 修改密码失败.
                            </div>
                        @endif
                        <div class="panel panel-default bootstrap-admin-no-table-panel">
                            <div class="panel-heading">
                                <div class="text-muted bootstrap-admin-box-title">密码</div>
                            </div>
                            <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                <form class="form-horizontal" action="{{URL::action('Admin\UserController@postEditPassword',Session::get('loginUser')->user_id)}}" method="POST">
                                    <fieldset>
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="old_password">旧密码</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" id="old_password" name="old_password" type="password" value="@if (!empty(Session::get('old_password'))){{Session::get('old_password')}}@endif">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="password">新密码</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" id="password" name="password" type="password" value="@if (!empty(Session::get('password'))){{Session::get('password')}}@endif">
                                            </div>
                                        </div>
                                        <div style="padding-left:115px;">
                                            <button type="submit" class="btn btn-primary">保存</button>
                                            <button type="reset" class="btn btn-default">取消</button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop