@include('common/header')
<body>
@include('common/top')

<div class="container-fluid content">

    <div class="row">

    @include('common/menu')
    <!-- start: Content -->
        <div class="main">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2><i class="fa fa-table red"></i><span class="break"></span><strong>菜单列表</strong></h2>
                        </div>
                        <div class="panel-body">
                            <div class="btn-toolbar" style="padding-bottom: 10px">
                                <?php if(in_array('add',$buttons) || $isadimin){?>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success btn-add " onclick="addMenu()">
                                            <i class="fa fa-plus"></i> 添加
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

                            <table class="table table-bordered  table-condensed table-hover"
                                   style="margin-bottom: 10px">
                                <thead>
                                <tr>
                                    <th><input data-index="1" name="btSelectItem" type="checkbox"></th>
                                    <th>ID</th>
                                    <th>标题</th>
                                    <th>图标</th>
                                    <th>规则URL</th>
                                    <th>权重</th>
                                    <th>状态</th>
                                    <th>类型</th>
                                    <th></th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($targetmenus as $targetmenu){?>
                                    <tr class = <?php echo  $targetmenu->ismenu == 3 ? "hidetr" : ""?> item="<?php echo $targetmenu->pid?>">
                                        <td><input data-index="1" name="btSelectItem" type="checkbox"></td>
                                        <td><?php echo $targetmenu->id;?></td>
                                        <td><?php echo $targetmenu->name;?></td>
                                        <td><i class="<?php echo $targetmenu->icon;?>"></i></td>
                                        <td><?php echo $targetmenu->url;?></td>
                                        <td><?php echo $targetmenu->weigh;?></td>
                                        <td>
                                            <span class="text-success"><i class="fa fa-circle"></i>
                                                    <?php echo !empty($targetmenu->status) && $targetmenu->status == 1 ? "正常" : "隐藏"  ; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if($targetmenu->ismenu == 1){?>
                                                <a href="javascript:;" class="btn btn-info btn-xs btn-change">目录</a>
                                            <?php }elseif($targetmenu->ismenu == 2){?>
                                                <a href="javascript:;" class="btn btn-info btn-xs btn-change">菜单</a>
                                            <?php }elseif($targetmenu->ismenu == 3){?>
                                                <a href="javascript:;" class="btn btn-info btn-xs btn-change">按钮</a>
                                            <?php }?>
                                        </td>
                                        <td>
                                            <?php if($targetmenu->ismenu != 3){?>
                                                <a href="javascript:;" onclick="openButton(<?php echo $targetmenu->id;?>)" data-id="1" data-pid="0" class="btn btn-xs btn-success btn-node-sub"><i class="fa fa-sitemap"></i></a>
                                            <?php }else{?>
                                                <a href="javascript:;"  data-id="1" data-pid="0" class="btn btn-xs btn-default btn-node-sub"><i class="fa fa-sitemap"></i></a>
                                            <?php }?>
                                        </td>
                                        <td>
                                            {{csrf_field()}}

                                            <?php if($targetmenu->ismenu != 3 && in_array('edit',$buttons) || $isadimin){?>
                                                <a class="btn btn-info" href="javascript:;" onclick="editMenu(<?php echo $targetmenu->id;?>)">
                                                    <i class="fa fa-edit "></i> 修改
                                                </a>
                                            <?php }?>
                                            <?php if(in_array('remove',$buttons) || $isadimin){?>
                                                <a class="btn btn-danger" href="javascript:;" onclick="removeMenu(<?php echo $targetmenu->id;?>)">
                                                    <i class="fa fa-trash-o "></i> 删除
                                                </a>
                                            <?php }?>
                                        </td>
                                    </tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!--/col-->
            </div><!--/row-->
        </div>
        <!-- start: Content -->
    </div>
</div>
<script type="text/javascript" src="{{ asset('assets/js/admin/menu.js') }}"></script>
@include('common/footer')