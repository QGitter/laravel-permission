@include('common/header')
<body>
<div class="container-fluid content">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body" style="border-bottom: none">
                <div class="alerts" id="alerts">
                    <div class="alert alert-success">
                        <i class='fa fa-check-circle'></i>&nbsp;&nbsp;请添加角色组信息
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon whitetext">父级：</span>
                        <div class="controls">
                            <select id="rolegroup" class="form-control" data-rel="chosen" name="rolegroup">
                                <?php foreach ($rolegroups as $rolegroup){?>
                                    <?php if(!empty($pid) && $pid == $rolegroup->id){?>
                                        <option value="<?php echo $rolegroup->id;?>" selected><?php echo $rolegroup->name;?></option>
                                    <?php }else{?>
                                        <option value="<?php echo $rolegroup->id;?>" ><?php echo $rolegroup->name;?></option>
                                    <?php }?>
                                <?php }?>
                            </select>
                        </div>
                        <span class="input-group-addon whitetext"><font color="red">*</font></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon whitetext">名称：</span>
                        <input type="text" id="name" name="name" class="form-control" placeholder="请输入角色组名" value="<?php echo !empty($rolegroupsObjById->name) ? $rolegroupsObjById->name : "";?>">
                        <span class="input-group-addon whitetext"><font color="red">*</font></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon whitetext">权限：</span>
                        <div class="panel panel-default">
                            <div class="panel-heading" style="margin:0px;padding:0px">
                                <ul class="nav tab-menu nav-tabs" id="myTab" style="float: left">
                                    <?php if(!empty($menus)){?>
                                        <?php foreach ($menus as $menu){?>
                                            <li><a href="#<?php echo "menu_".$menu['id'];?>"><?php echo $menu['name'];?></a></li>
                                        <?php }?>
                                    <?php }?>
                                </ul>
                            </div>
                            <div class="panel-body">

                                <div id="myTabContent" class="tab-content">
                                    <?php if(!empty($menus)){?>
                                        <?php foreach ($menus as $menu){?>
                                                <div class="tab-pane" id="<?php echo "menu_".$menu['id'];?>">
                                                    <table class="table table-bordered  table-condensed">
                                                        <thead>
                                                        <tr>
                                                            <td>模块</td>
                                                            <td>子模块</td>
                                                            <td class="nobreak">操作</td>
                                                        </tr>
                                                        </thead>

                                                        <tbody>
                                                            <tr>
                                                                <td rowspan="<?php echo !empty($menu['child']) ? count($menu['child']) + 1 : "1"?>" width="100">
                                                                    <input class="diritem" dirid="<?php echo $menu['id'];?>" value="<?php echo $menu['id'];?>" type="checkbox" <?php echo isset($selectmenus) && in_array($menu['id'],$selectmenus) ? " checked " : "";?>>
                                                                    <span style="font-size:13px"><?php echo $menu['name'];?></span>
                                                                </td>
                                                            </tr>

                                                       <?php foreach ($menu['child'] as $submenu){?>
                                                            <tr>
                                                                <td width="150">
                                                                    <input class="menu"  dirid="<?php echo $menu['id']; ?>" menuid="<?php echo $submenu['id'];?>"  value="<?php echo $submenu['id'];?>" type="checkbox" <?php echo isset($selectmenus) && in_array($submenu['id'],$selectmenus) ? " checked " : "";?>>
                                                                    <span style="font-size:13px"><?php echo $submenu['name'];?></span>
                                                                </td>
                                                                <td class="nobreak">
                                                                    <?php if(!empty($submenu['child'])){?>
                                                                        <?php foreach ($submenu['child'] as  $kb=>$cb){?>
                                                                            <input class="button" menuid="<?php echo $submenu['id'];?>" dirid="<?php echo $menu['id']; ?>"  value="<?php echo $cb['id'];?>" type="checkbox" <?php echo isset($selectmenus) && in_array($cb['id'],$selectmenus) ? " checked " : "";?>>
                                                                            <span style="font-size:13px"><?php echo $cb['name'];?></span>
                                                                        <?php }?>
                                                                    <?php }?>
                                                                </td>
                                                            </tr>
                                                        <?php }?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php }?>
                                        <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon whitetext ">状态：</span>
                        <label class="radio-inline" for="inline-radio1">
                            <input id="inline-radio1" name="status" value="1" type="radio" <?php echo !empty($rolegroupsObjById->status) && $rolegroupsObjById->status ==1 ? "checked" : "checked";?>> 正常
                        </label>
                        <label class="radio-inline" for="inline-radio2">
                            <input id="inline-radio2" name="status" value="2" type="radio" <?php echo !empty($rolegroupsObjById->status) && $rolegroupsObjById->status == 2 ? "checked" : "";?>> 隐藏
                        </label>
                    </div>
                </div>
                <div class="form-group form-actions pull-right">
                    {{ csrf_field() }}
                    <input type="hidden" value="<?php echo !empty($rolegroupsObjById->id) ? $rolegroupsObjById->id : "";?>" id="roleid">
                    <input type="hidden" value="<?php echo !empty($action) ? $action : "";?>" id="action" />
                    <button type="button" class="btn  btn-success" onclick="confirmAddRole()"> 确定</button>
                    <button type="button" class="btn  btn-default" onclick="cancelAddRole()"> 取消</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('assets/js/admin/role.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".diritem").click(function(){
            var value = $(this).val();
            if($(this).prop("checked")){
                $.each($("#menu_"+value).find(".menu,.button"), function(index, val) {
                     $(this).prop("checked",true);
                });
            }else{
                 $.each($("#menu_"+value).find(".menu,.button"), function(index, val) {
                     $(this).prop("checked",false);
                 });
            }
        });
        
        $(".menu").click(function(){
            var dirid = $(this).attr('dirid');
            var menuid = $(this).attr('menuid');
            var dirBooleanArray = [];
            var dirBoolean = false;
            
            $.each($("#menu_"+dirid).find(".menu"),function(index, val){
                dirBooleanArray.push($(this).prop("checked"))
            })

            var dirBooleanArrayNum = dirBooleanArray.length
            for(var i=0;i<dirBooleanArrayNum;i++){
                dirBoolean = dirBoolean || dirBooleanArray[i];
            }
            if(dirBoolean){
                $("#menu_"+dirid).find(".diritem").prop("checked",true)
            }else{
                $("#menu_"+dirid).find(".diritem").prop("checked",false)
            }
            
            if($(this).prop("checked")){
                $.each($("#menu_"+dirid).find(".button"), function(index, val) {
                    if($(this).attr("menuid") == menuid){
                        $(this).prop("checked",true);
                    }
                });
            }else{
                $.each($("#menu_"+dirid).find(".button"), function(index, val) {
                    if($(this).attr("menuid") == menuid){
                        $(this).prop("checked",false);
                    }
                });
            }
        });

        $(".button").click(function(){
            var buttonArray = new Array()
            var buttonBoolean = false;
            var menuArray = new Array()
            var menuBoolean = false;
            var dirArray = new Array();
            var dirBoolean = false;
            var menuid =$(this).attr("menuid");
            var dirid = $(this).attr("dirid");
            
            $.each($("#menu_"+dirid).find(".button"), function(index, val) {
                    buttonArray.push($(this).prop("checked"));
            });
            
            $.each($("#menu_"+dirid).find(".button"), function(index, val) {
                if($(this).attr("menuid") == menuid){
                    menuArray.push($(this).prop("checked"));
                }
            });

            var buttonArrayNum = buttonArray.length;
            var menuArrayNum = menuArray.length;

            for(var i=0;i<menuArrayNum;i++){
                menuBoolean = menuBoolean || menuArray[i];
            }
            for(var i=0;i<buttonArrayNum;i++){
                buttonBoolean = buttonBoolean || buttonArray[i];
            }

            //如果有选中的按钮
            if(buttonBoolean){
                $("#menu_"+dirid).find(".diritem").prop("checked",true)
            }else{
                $("#menu_"+dirid).find(".diritem").prop("checked",false)
            }

            //
            if(menuBoolean){
                $.each($("#menu_"+dirid).find(".menu"), function(index, val) {
                    if($(this).attr("menuid") == menuid){
                        $(this).prop("checked",true)
                    }
                });
            }else{
                $.each($("#menu_"+dirid).find(".menu"), function(index, val) {
                    if($(this).attr("menuid") == menuid){
                        $(this).prop("checked",false)
                    }
                });
            }

            $.each($("#menu_"+dirid).find(".menu"),function (index,val) {
                dirArray.push($(this).prop("checked"));
            });
            var dirArrayNum = dirArray.length;
            for(var i=0;i<dirArrayNum;i++){
                dirBoolean = dirBoolean || dirArray[i];
            }
            if(dirBoolean){
                $("#menu_"+dirid).find(".diritem").prop("checked",true)
            }else{
                $("#menu_"+dirid).find(".diritem").prop("checked",false)
            }
        });


    });
</script>
@include('common/footer')