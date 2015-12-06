@extends('admin.layouts.master')
@section('title', '角色信息')
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
                            <h1>{{$roleInfo->role_name}}<a href="{{URL::previous()}}?callback={{Input::get('callback','')}}" class="btn btn-large btn-primary" style="float:right;"> 《 返回</a></h1>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered table-striped">
                            <colgroup>
                                <col class="span1">
                                <col class="span7">
                            </colgroup>
                            <thead>
                            <tr>
                                <th style='width:150px;'>字段</th>
                                <th>内容</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <code>角色名</code>
                                </td>
                                <td>{{$roleInfo->role_name}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <code>权限组</code>
                                </td>
                                <td>{{$roleInfo->auth_group}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop