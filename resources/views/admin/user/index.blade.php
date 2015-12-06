@extends('admin.layouts.master')
@section('title', '用户列表')
@section('content')
    <script type="text/javascript" src="{{ asset('assets/admin/vendors/teninedialog/jquery/jquery.bootstrap.teninedialog.v3.min.js') }}"></script>
    <script type="text/javascript">
        @if (Session::has('dialog'))
            $.teninedialog({
            title:"{{Session::get('dialog')['title']}}",
            content:"&nbsp;&nbsp;&nbsp;用户名:{{Session::get('dialog')['message']['username']}}<br/>&nbsp;&nbsp;&nbsp;姓名:{{Session::get('dialog')['message']['truename']}}<br/>"
        });
        @endif
        function deleteContent(url,username)
        {
            $.teninedialog({
                title: '系统提示',
                content: '确认删除用户【'+username+'】?',
                //url:'1.txt',
                showCloseButton: true,
                otherButtons: ["确定"],
                otherButtonStyles: ['btn-primary', 'btn-primary'],
                bootstrapModalOption: {
                    keyboard: true
                },
                clickButton: function(sender, modal, index) {
                    if (index == 0) {
                        $('#deleteUser').attr('action', url);
                        $("#deleteUser").submit();
                    }
                    $(this).closeDialog(modal);
                }
            });
        }
    </script>
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
                            <h1>用户列表</h1>
                        </div>
                    </div>
                </div>
                <div style="margin-bottom:10px;text-align:right;">
                    <button class="btn btn-danger" onclick="window.location.href='{{URL::route('user.create')}}'">+ 增加用户</button>
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
                                <strong>Success!</strong> 删除用户成功.
                            </div>
                        @endif
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="text-muted bootstrap-admin-box-title">用户</div>
                            </div>
                            <div class="bootstrap-admin-panel-content">
                                <table class="table table-striped table-bordered" id="example">
                                    <thead>
                                    <tr>
                                        <th>编号</th>
                                        <th>用户名</th>
                                        <th>姓名</th>
                                        <th>邮箱</th>
                                        <th>手机</th>
                                        <th>角色</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($userList as $item)
                                        <tr>
                                            <td>{{$item->user_id}}</td>
                                            <td>{{$item->username}}</td>
                                            <td>{{$item->truename}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->mobile}}</td>
                                            <td>{{$item->userRole['role_name']}}</td>
                                            <td>@if('locked' === $item->status)锁定@elseif('normal' === $item->status)正常@endif</td>
                                            <td class="center" style="width:70px;">
                                                <div class="btn-group">
                                                    <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown" style="padding:2px 10px;">操作<span class="caret"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="{{ URL::route('user.show',$item->user_id)}}">用户详情</a></li>
                                                        <li><a href="{{ URL::route('user.edit',$item->user_id)}}">编辑</a></li>
                                                        <li>
                                                            <a href="javascript:void(0);" onclick="deleteContent('{{ URL::route('user.destroy',$item->user_id)}}','{{$item->username}}')">删除</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div style="text-align:right;padding;right:10px;">
                                    <?php echo $userList->render(); ?>
                                </div>
                                <form method="POST" name="deleteUser" id="deleteUser">
                                    <input name="_method" type="hidden" value="DELETE">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop