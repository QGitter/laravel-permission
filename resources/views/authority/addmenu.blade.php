@include('common/header')
<body>
<div class="container-fluid content">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body" style="border-bottom: none">
                <div class="alerts" id="alerts">
                    <div class="alert alert-success">
                        <i class='fa fa-check-circle'></i>&nbsp;&nbsp;请添加菜单信息
                    </div>
                </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon whitetext textright">类型：</span>
                            <label class="radio-inline" for="inline-radio1" >
                                <input id="dir" name="ismenu" value="1" onclick="filterDir()" type="radio" <?php echo !empty($menus->ismenu) && $menus->ismenu==1 ? "checked" : "checked";?>> 目录
                            </label>
                            <label class="radio-inline" for="inline-radio2" >
                                <input id="dirmenu" name="ismenu" value="2" onclick="filterMenu()" type="radio" <?php echo !empty($menus->ismenu) && $menus->ismenu==2 ? "checked" : "";?>> 菜单
                            </label>
                            <?php if($action == "add"){?>
                            <label class="radio-inline" for="inline-radio1" >
                                <input id="menubutton" name="ismenu" onclick="filterButton()" value="3" type="radio" <?php echo !empty($menus->ismenu) && $menus->ismenu==3 ? "checked" : "";?>> 按钮
                            </label>
                            <?php }?>

                        </div>
                    </div>

                    <div class="form-group" id="expectButton">
                        <div class="input-group">
                            <span class="input-group-addon whitetext textright">名称：</span>
                            <input type="text" id="name" name="name" class="form-control" placeholder="请输入菜单或按钮名称" value="<?php echo !empty($menus->name) ? $menus->name : "" ;?>">
                            <span class="input-group-addon whitetext"><font color="red">*</font></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon whitetext textright">父级：</span>
                            <div class="controls">
                                <select id="parentmenu" class="form-control"  name="parentmenu">
                                    <option value="0">一级菜单</option>
                                    <?php foreach ($targetmenus as $targetmenu){?>
                                        <?php if(!empty($menus->pid) && $menus->pid == $targetmenu->id){?>
                                            <option value="<?php echo $targetmenu->id;?>" selected><?php echo $targetmenu->name;?></option>
                                        <?php }else{?>
                                            <option value="<?php echo $targetmenu->id;?>"><?php echo $targetmenu->name;?></option>
                                        <?php }?>
                                    <?php }?>
                                </select>
                            </div>
                            <span class="input-group-addon whitetext "><font color="red">*</font></span>
                        </div>
                    </div>

                    <div class="form-group menubutton" id="selectmenu">
                        <div class="input-group">
                            <span class="input-group-addon whitetext textright">按钮：</span>
                            <button type="button" class="btn btn-default btn-sm" data="add">
                                <i class="fa fa-plus"></i>
                                <span class="text">增加</span>
                            </button>
                            <button type="button" class="btn btn-default btn-sm" data="remove">
                                <i class="fa fa-trash-o"></i>
                                <span class="text">删除</span>
                            </button>
                            <button type="button" class="btn btn-default btn-sm" data="edit">
                                <i class="fa fa-edit "></i>
                                <span class="text">修改</span>
                            </button>
                            <button type="button" class="btn btn-default btn-sm" data="search">
                                <i class="fa fa-search-plus "></i>
                                <span class="text">搜索</span>
                            </button>
                            <button type="button" class="btn btn-default btn-sm" data="export">
                                <i class="fa  fa-chevron-circle-down"></i>
                                <span class="text">导出</span>
                            </button>
                            <button type="button" class="btn btn-default btn-sm" data="import">
                                <i class="fa fa-chevron-circle-up"></i>
                                <span class="text">导入</span>
                            </button>
                            <button type="button" class="btn btn-default btn-sm" data="details">
                                <i class="fa fa-list"></i>
                                <span class="text">详情</span>
                            </button>
                            <button type="button" class="btn btn-default btn-sm" data="move">
                                <i class="fa fa-arrow-right"></i>
                                <span class="text">移动</span>
                            </button>
                            <button type="button" class="btn btn-default btn-sm" data="openall">
                                <i class="fa fa-sitemap"></i>
                                <span class="text">展开所有</span>
                            </button>
                            <button type="button" class="btn btn-default btn-sm" data="resetpwd">
                                <i class="fa fa-cog"></i>
                                <span class="text">重置密码</span>
                            </button>
                            <button type="button" class="btn btn-default btn-sm" data="print">
                                <i class="fa fa-print"></i>
                                <span class="text">打印</span>
                            </button>
                            <button type="button" class="btn btn-default btn-sm" data="download">
                                <i class="fa fa-download"></i>
                                <span class="text">下载</span>
                            </button>
                            <button type="button" class="btn btn-default btn-sm" data="upload">
                                <i class="fa fa-upload"></i>
                                <span class="text">上传</span>
                            </button>
                        </div>
                    </div>

                    <div class="form-group dirmenu " <?php echo !empty($menus) && $menus->ismenu == 2 ? 'style="display: block"': "" ?>>
                        <div class="input-group">
                            <span class="input-group-addon whitetext textright">规则url：</span>
                            <input type="text" id="url" name="url" class="form-control" placeholder="请输入规则url" value="<?php echo !empty($menus->url) ? $menus->url : "" ;?>">
                            <span class="input-group-addon whitetext"><font color="red">*</font></span>
                        </div>
                    </div>


                    <div class="form-group" id="selecticon">
                        <div class="input-group">
                            <span class="input-group-addon whitetext textright">图标：</span>
                            <input type="text" id="icon" name="icon" disabled class="form-control" placeholder="请选择图标" value="<?php echo !empty($menus->icon) ? $menus->icon : "" ;?>">
                            <span class="input-group-addon " onclick="searchIcon()" style="cursor: pointer">搜索图标</span>
                            <span class="input-group-addon whitetext"><font color="red">*</font></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon whitetext textright">权重：</span>
                            <input type="number" id="weigh" name="weigh" class="form-control"
                                   placeholder="请输入权重值"  value="<?php echo !empty($menus->weigh) ? $menus->weigh : "1" ;?>">
                            <span class="input-group-addon whitetext"><font color="red">*</font></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon whitetext textright">状态：</span>
                            <label class="radio-inline" for="inline-radio1">
                                <input id="inline-radio1" name="status" value="1" type="radio" <?php echo !empty($menus->status) && $menus->status==1 ? "checked" : "checked";?>> 正常
                            </label>
                            <label class="radio-inline" for="inline-radio2">
                                <input id="inline-radio2" name="status" value="2" type="radio" <?php echo !empty($menus->status) && $menus->status==2 ? "checked" : "";?>> 隐藏
                            </label>
                        </div>
                    </div>

                    <div class="form-group form-actions pull-right">
                        {{csrf_field()}}
                        <input type="hidden" id="action" value="<?php echo $action;?>"/>
                        <input type="hidden" id="menuid" value="<?php echo !empty($menus->id) ? $menus->id : "";?>" />
                        <button type="button" class="btn  btn-success" onclick="confirmAddMenu()"> 确定</button>
                        <button type="button" class="btn  btn-default" onclick="cancelAddMenu()"> 取消</button>
                    </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('assets/js/admin/menu.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $.each($("#selectmenu").find('.btn'), function(index, val) {
            $(this).click(function(){
                if($(this).hasClass('btn-default')){
                    $(this).removeClass('btn-default').addClass('btn-success')
                }else if($(this).hasClass('btn-success')){
                    $(this).removeClass('btn-success').addClass('btn-default')
                }
            });
        });
    });
</script>
@include('common/footer')