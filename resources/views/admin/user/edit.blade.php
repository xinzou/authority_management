@extends('admin.layouts.master')
@section('title', '修改用户')
@section('content')
    <div class="container">
        <!-- left, vertical navbar & content -->
        <div class="row">
            <!-- left, vertical navbar -->
            @include('admin.layouts.left')
                    <!-- content -->
            <div class="col-md-10">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                            <h1>修改用户</h1>
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
                        <div class="panel panel-default bootstrap-admin-no-table-panel">
                            <div class="panel-heading">
                                <div class="text-muted bootstrap-admin-box-title">用户信息</div>
                            </div>
                            <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                <form class="form-horizontal" action="{{URL::route('user.update',$userInfo->user_id)}}" method="post">
                                    <fieldset>
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                                        <input type="hidden" name="_method" value="PUT"/>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="username">用户名</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" id="username" name="username" type="text" value="@if (!empty(Session::get('username'))){{Session::get('username')}}@elseif($userInfo->username){{$userInfo->username}}@endif">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="truename">姓  名</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" id="truename" name="truename" type="text" value="@if (!empty(Session::get('truename'))){{Session::get('truename')}}@elseif($userInfo->truename){{$userInfo->truename}}@endif">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="mobile">移动电话</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" id="mobile" name="mobile" type="text" value="@if (!empty(Session::get('mobile'))){{Session::get('mobile')}}@elseif($userInfo->mobile){{$userInfo->mobile}}@endif">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="landline">email</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" id="email" name="email" type="text" value="@if (!empty(Session::get('email'))){{Session::get('email')}}@elseif($userInfo->email){{$userInfo->email}}@endif">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="role_id">角色</label>
                                            <div class="col-lg-10">
                                                <select name="role_id" class="form-control" style="width: 150px">
                                                    @foreach ($roleList as $role)
                                                        <option value="{{$role->role_id}}" @if (Session::get('role_id') === $role->role_id) selected='true'@elseif($userInfo->role_id === $role->role_id) selected='true'@endif>{{$role->role_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="status">状态</label>
                                            <div class="col-lg-10">
                                                <select id="status" name="status" class="form-control" style="width: 150px">
                                                    <option value="normal"@if (Session::get('status') === 'normal') selected="true"@endif>正常</option>
                                                    <option value="locked"@if (Session::get('status') === 'locked') selected="true"@endif>锁定</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div style="padding-left:90px;">
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