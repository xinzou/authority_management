@extends('admin.layouts.master')
@section('title', '新增角色')
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
                            <h1>新增角色</h1>
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
                                <div class="text-muted bootstrap-admin-box-title">角色信息</div>
                            </div>
                            <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                <form class="form-horizontal" action="{{URL::route('role.store')}}" method="post">
                                    <fieldset>
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="role_name">角色名</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" id="role_name" name="role_name" type="text" value="@if (!empty(Session::get('role_name'))){{Session::get('role_name')}}@endif">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="auth_group">权限组</label>
                                            <div class="col-lg-10">
                                                <select id="auth_group" name="auth_group" class="form-control" style="width: 150px">
                                                    @foreach ($authGroupList as $val)
                                                        <option value="{{$val->group_label}}"@if (Session::get('group_label') === $val->group_label) selected="true"@endif>{{$val->group_name}}</option>
                                                    @endforeach
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