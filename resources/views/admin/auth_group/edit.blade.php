@extends('admin.layouts.master')
@section('title', '修改权限组')
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
                            <h1>修改权限组</h1>
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
                                <div class="text-muted bootstrap-admin-box-title">权限组</div>
                            </div>
                            <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                <form class="form-horizontal" action="{{URL::route('auth_group.update',$authGroupInfo->group_label)}}" method="post">
                                    <fieldset>
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                                        <input type="hidden" name="_method" value="PUT"/>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="group_label">权限组标签</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" id="group_label" name="group_label" type="text" value="@if (!empty(Session::get('group_label'))){{Session::get('group_label')}}@elseif($authGroupInfo->group_label){{$authGroupInfo->group_label}}@endif">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="group_name">权限组名</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" id="group_name" name="group_name" type="text" value="@if (!empty(Session::get('group_name'))){{Session::get('group_name')}}@elseif($authGroupInfo->group_name){{$authGroupInfo->group_name}}@endif">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="default_path">权限登录(Action)</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" id="default_path" name="default_path" type="text" value="@if (!empty(Session::get('default_path'))){{Session::get('default_path')}}@elseif($authGroupInfo->default_path){{$authGroupInfo->default_path}}@endif">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="default_path">关联权限</label>
                                            <div class="col-lg-10">
                                                @foreach($authList as $key => $val_g)
                                                    <div class="row" style="max-height:300px;overflow: scroll;overflow-y:auto;overflow-x:hidden;;">
                                                        <fieldset>
                                                            <legend style="font-size: 14px; font-weight:bold;margin-bottom:5px;">{{$key}}</legend>
                                                            @foreach($val_g as $v)
                                                                <label class="uniform col-lg-3">
                                                                    <input type="checkbox" name="auth[]" value="{{$v->auth_label}}" @if (Session::has('auth') && in_array($v->auth_label,Session::get('auth')))checked="true"@elseif($v->selected)checked="true"@endif>
                                                                    {{$v->auth_name}}
                                                                </label>
                                                            @endforeach
                                                        </fieldset>
                                                    </div>
                                                @endforeach
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