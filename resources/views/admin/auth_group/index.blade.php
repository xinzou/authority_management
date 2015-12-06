@extends('admin.layouts.master')
@section('title', '权限组信息列表')
@section('content')
    <script type="text/javascript" src="{{ asset('assets/admin/vendors/teninedialog/jquery/jquery.bootstrap.teninedialog.v3.min.js') }}"></script>
    <script type="text/javascript">
        @if (Session::has('dialog'))
            $.teninedialog({
            title:"{{Session::get('dialog')['title']}}",
            content:"&nbsp;&nbsp;&nbsp;权限组标签:{{Session::get('dialog')['message']['group_label']}}<br/>&nbsp;&nbsp;&nbsp;权限组名:{{Session::get('dialog')['message']['group_name']}}<br/>&nbsp;&nbsp;&nbsp;默认地址:{{Session::get('dialog')['message']['default_path']}}<br/>"
        });
        @endif
        function deleteContent(url,group_name)
        {
            $.teninedialog({
                title: '系统提示',
                content: '确认删除权限组【'+group_name+'】?',
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
                            <h1>权限组列表</h1>
                        </div>
                    </div>
                </div>
                <div style="margin-bottom:10px;text-align:right;">
                    <button class="btn btn-danger" onclick="window.location.href='{{URL::route('auth_group.create')}}'">+ 增加权限组</button>
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
                                <strong>Success!</strong> 删除权限组成功.
                            </div>
                        @endif
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="text-muted bootstrap-admin-box-title">权限组</div>
                            </div>
                            <div class="bootstrap-admin-panel-content">
                                <table class="table table-striped table-bordered" id="example">
                                    <thead>
                                    <tr>
                                        <th>权限组标签</th>
                                        <th>权限组名</th>
                                        <th>权限登录(Action)</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($authGroupList as $item)
                                        <tr>
                                            <td>{{$item->group_label}}</td>
                                            <td>{{$item->group_name}}</td>
                                            <td>{{$item->default_path}}</td>
                                            <td class="center" style="width:70px;">
                                                <div class="btn-group">
                                                    <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown" style="padding:2px 10px;">操作<span class="caret"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="{{ URL::route('auth_group.edit',$item->group_label)}}">编辑</a></li>
                                                        <li>
                                                            <a href="javascript:void(0);" onclick="deleteContent('{{ URL::route('auth_group.destroy',$item->group_label)}}','{{$item->group_name}}')">删除</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div style="text-align:right;padding;right:10px;">
                                    <?php echo $authGroupList->render(); ?>
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