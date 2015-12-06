@extends('admin.layouts.master')
@section('title', '新增权限信息')
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
                            <h1>新增权限信息</h1>
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
                                <div class="text-muted bootstrap-admin-box-title">权限信息</div>
                            </div>
                            <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                <form class="form-horizontal" action="{{URL::route('auth.store')}}" method="post">
                                    <fieldset>
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="auth_label">权限标签</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" id="auth_label" name="auth_label" type="text" value="@if (!empty(Session::get('auth_label'))){{Session::get('auth_label')}}@endif">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="auth_name">权限名</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" id="auth_name" name="auth_name" type="text" value="@if (!empty(Session::get('auth_name'))){{Session::get('auth_name')}}@endif">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="auth_type">权限类型</label>
                                            <div class="col-lg-10">
                                                <select id="auth_type" name="auth_type" class="form-control" style="width: 150px">
                                                    @foreach($auth_type as $val)
                                                        <option value="{{$val}}"@if (Session::get('auth_type') === $val) selected="true"@endif>{{$val}}</option>
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