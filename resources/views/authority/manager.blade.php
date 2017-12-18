@include('common/header')
<body>
@include('common/top')

<div class="container-fluid content">

    <div class="row">

    @include('common/menu')
    <!-- start: Content -->
        <div class="main">
            <!-- 位置导航栏 -->
 {{--           <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="index.html">首页</a></li>
                        <li><i class="fa fa-laptop"></i>管理员管理</li>
                    </ol>
                </div>
            </div>--}}
            <!-- 位置导航栏 -->


            <div class="row">


                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2><i class="fa fa-table red"></i><span class="break"></span><strong>管理员列表</strong></h2>
                        </div>
                        <div class="panel-body">


                            <div class="btn-toolbar" style="padding-bottom: 10px">
                                <?php if(in_array('add',$buttons) || $isadimin){?>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success btn-add " onclick="addManager()"><i class="fa fa-plus"></i> 添加
                                        </button>
                                    </div>
                                <?php }?>


                                    <?php if(in_array('export',$buttons) || $isadimin){?>
                                <div class="btn-group pull-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary" data-toggle="dropdown">导出<span
                                                    class="caret"></span></button>
                                        <ul class="dropdown-menu pull-right" role="menu"
                                            aria-labelledby="btnGroupDrop1">
                                            <li><a href="#">EXCEL</a></li>
                                            <li><a href="#">PDF</a></li>
                                            <li><a href="#">WORLD</a></li>
                                            <li><a href="#">JSON</a></li>
                                            <li><a href="#">XML</a></li>
                                            <li><a href="#">CSV</a></li>
                                            <li><a href="#">TXT</a></li>
                                        </ul>
                                    </div>
                                </div>
                                    <?php }?>

                                    <?php if(in_array('search',$buttons) || $isadimin){?>
                                <div class="btn-group pull-right">
                                    <button type="button" class="btn btn-primary"><i class="fa fa-search-plus "></i>
                                        搜索
                                    </button>
                                </div>
                                    <?php }?>
                            </div>


                            <table class="table table-bordered table-striped table-condensed table-hover"
                                   style="margin-bottom: 10px">
                                <thead>
                                <tr>
                                    <th><input data-index="1" name="btSelectItem" type="checkbox"></th>
                                    <th>ID</th>
                                    <th>用户名</th>
                                    <th>昵称</th>
                                    <th>所属组别</th>
                                    <th>Email</th>
                                    <th>状态</th>
                                    <th>最后登录</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($users as $user){?>
                                    <tr>
                                        <td><input data-index="1" name="btSelectItem" type="checkbox"></td>
                                        <td><?php echo  $user->id; ?></td>
                                        <td><?php echo $user->username; ?></td>
                                        <td><?php echo $user->nickname; ?></td>
                                        <td><span class="label label-success"><?php echo $user->name; ?></span></td>
                                        <td><?php echo $user->email; ?></td>
                                        <td>
                                            <span class="text-success"><i class="fa fa-circle"></i>
                                                <?php echo !empty($user->status) && $user->status == 1 ? "正常" : "隐藏"  ; ?>
                                            </span>
                                        </td>
                                        <td><?php echo date('Y-m-d H:i:s',$user->logintime);?></td>
                                        <td>
                                            {{ csrf_field() }}

                                            <?php if($user->pid != 0 ){?>
                                                <?php if(in_array('edit',$buttons) || $isadimin){?>
                                                <a class="btn btn-info" href="javascript:;" onclick="editManager(<?php echo $user->id;?>)">
                                                    <i class="fa fa-edit "></i> 修改
                                                </a>
                                                <?php }?>
                                            <?php if(in_array('remove',$buttons) || $isadimin){?>
                                                <a class="btn btn-danger" href="javascript:;" onclick="removeManager(<?php echo $user->id;?>)">
                                                    <i class="fa fa-trash-o "></i> 删除
                                                </a>
                                            <?php }?>
                                            <?php if(in_array('resetpwd',$buttons) || $isadimin){?>
                                                <a class="btn btn-danger" href="javascript:;" onclick="resetPassword(<?php echo $user->id;?>)">
                                                    <i class="fa fa-trash-o "></i> 重置密码
                                                </a>
                                            <?php }?>
                                            <?php }?>

                                        </td>
                                    </tr>
                                <?php }?>


                                </tbody>
                            </table>
                            <ul class="pagination" style="float: right">
                                {{ $users->links() }}
                            </ul>
                        </div>
                    </div>
                </div><!--/col-->
            </div><!--/row-->
        </div>
        <!-- start: Content -->
    </div>
</div>


<script type="text/javascript" src="{{ asset('assets/js/admin/manager.js') }}"></script>
@include('common/footer')