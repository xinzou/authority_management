@extends('admin.layouts.master')
@section('title', '权限信息列表')
@section('content')
    <script type="text/javascript" src="{{ asset('assets/admin/vendors/teninedialog/jquery/jquery.bootstrap.teninedialog.v3.min.js') }}"></script>
    <script type="text/javascript">
        @if (Session::has('dialog'))
            $.teninedialog({
            title:"{{Session::get('dialog')['title']}}",
            content:"&nbsp;&nbsp;&nbsp;权限标签:{{Session::get('dialog')['message']['auth_label']}}<br/>&nbsp;&nbsp;&nbsp;权限名:{{Session::get('dialog')['message']['auth_name']}}<br/>&nbsp;&nbsp;&nbsp;权限类型:{{Session::get('dialog')['message']['auth_type']}}<br/>"
        });
        @endif
        function deleteContent(url,auth_name)
        {
            $.teninedialog({
                title: '系统提示',
                content: '确认删除权限信息【'+auth_name+'】?',
                //url:'1.txt',
                showCloseButton: true,
                otherButtons: ["确定"],
                otherButtonStyles: ['btn-primary', 'btn-primary'],
                bootstrapModalOption: {
                    keyboard: true
                },
                clickButton: function(sender, modal, index) {
                    if (index == 0) {
                        $('#deleteAuth').attr('action', url);
                        $("#deleteAuth").submit();
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
                            <h1>权限信息列表</h1>
                        </div>
                    </div>
                </div>
                <div style="margin-bottom:10px;text-align:right;">
                    <button class="btn btn-danger" onclick="window.location.href='{{URL::route('auth.create')}}'">+ 增加权限信息</button>
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
                                <strong>Success!</strong> 删除权限信息成功.
                            </div>
                        @endif
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="text-muted bootstrap-admin-box-title">权限信息</div>
                            </div>
                            <div class="bootstrap-admin-panel-content">
                                <table class="table table-striped table-bordered" id="example">
                                    <thead>
                                    <tr>
                                        <th>权限标签</th>
                                        <th>权限名</th>
                                        <th>权限类型</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($authList as $item)
                                        <tr>
                                            <td>{{$item->auth_label}}</td>
                                            <td>{{$item->auth_name}}</td>
                                            <td>{{$item->auth_type}}</td>
                                            <td class="center" style="width:70px;">
                                                <div class="btn-group">
                                                    <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown" style="padding:2px 10px;">操作<span class="caret"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="{{ URL::route('auth.edit',$item->auth_label)}}">编辑</a></li>
                                                        <li>
                                                            <a href="javascript:void(0);" onclick="deleteContent('{{ URL::route('auth.destroy',$item->auth_label)}}','{{$item->auth_name}}')">删除</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div style="text-align:right;padding;right:10px;">
                                    <?php echo $authList->render(); ?>
                                </div>
                                <form method="POST" name="deleteAuth" id="deleteAuth">
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