@extends('admin.layouts.master')
@section('title', '用户信息')
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
                            <h1>{{$userInfo->username}}<a href="{{URL::previous()}}?callback={{Input::get('callback','')}}" class="btn btn-large btn-primary" style="float:right;"> 《 返回</a></h1>
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
                                    <code>姓名</code>
                                </td>
                                <td>{{$userInfo->truename}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <code>邮箱</code>
                                </td>
                                <td>{{$userInfo->email}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <code>手机</code>
                                </td>
                                <td>{{$userInfo->mobile}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <code>状态</code>
                                </td>
                                <td>@if('locked' === $userInfo->status)锁定@elseif('normal' === $userInfo->status)正常@endif</td>
                            </tr>

                            <tr>
                                <td>
                                    <code>上传时间</code>
                                </td>
                                <td>{{$userInfo->created_at}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop