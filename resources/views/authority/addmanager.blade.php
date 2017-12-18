@include('common/header')
<body>
<div class="container-fluid content">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body" style="border-bottom: none">
                <div class="alerts" id="alerts">
                    <div class="alert alert-success">
                        <i class='fa fa-check-circle'></i>&nbsp;&nbsp;请添加管理员信息
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon whitetext textright">所属组别：</span>
                        <div class="controls">
                            <select id="rolegroup" class="form-control" data-rel="chosen" name="rolegroup">
                                <?php foreach ($rolegroups as $rolegroup){?>
                                <?php if(!empty($selectrole) && $rolegroup->id == $selectrole){?>
                                <option value="<?php echo $rolegroup->id;?>"
                                        selected><?php echo $rolegroup->name; ?></option>
                                <?php }else{?>
                                <option value="<?php echo $rolegroup->id;?>"><?php echo $rolegroup->name;?></option>
                                <?php }?>
                                <?php }?>
                            </select>
                        </div>
                        <span class="input-group-addon whitetext"><font color="red">*</font></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon whitetext textright">用户名：</span>
                        <input type="text" id="username" name="username" class="form-control" placeholder="请输入用户名"
                               value="<?php echo !empty($managerObj->username) ? $managerObj->username : '';?>">
                        <span class="input-group-addon whitetext"><font color="red">*</font></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon whitetext textright">Email：</span>
                        <input type="text" id="email" name="email" class="form-control" placeholder="请输入Email"
                               value="<?php echo !empty($managerObj->email) ? $managerObj->email : '';?>">
                        <span class="input-group-addon whitetext"><font color="red">*</font></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon whitetext textright">昵称：</span>
                        <input type="text" id="nickname" name="nickname" class="form-control" placeholder="请输入昵称"
                               value="<?php echo !empty($managerObj->nickname) ? $managerObj->nickname : '';?>">
                        <span class="input-group-addon whitetext"><font color="red">*</font></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon whitetext textright">状态：</span>
                        <label class="radio-inline" for="inline-radio1">
                            <input id="inline-radio1" name="status" value="1"
                                   type="radio" <?php echo !empty($managerObj->status) && $managerObj->status == 1 ? "checked" : "checked";?> >
                            正常
                        </label>
                        <label class="radio-inline" for="inline-radio2">
                            <input id="inline-radio2" name="status" value="2"
                                   type="radio" <?php echo !empty($managerObj->status) && $managerObj->status == 2 ? "checked" : "";?>>
                            隐藏
                        </label>
                    </div>
                </div>
                <div class="form-group form-actions pull-right">
                    {{ csrf_field() }}
                    <input type="hidden" id="mangerid"
                           value="<?php echo !empty($managerObj->id) ? $managerObj->id : "";?>"/>
                    <input type="hidden" id="action" value="<?php echo $action;?>">
                    <button type="button" class="btn  btn-success" onclick="confirmAddManager()"> 确定</button>
                    <button type="button" class="btn  btn-default" onclick="cancelManager()"> 取消</button>
                </div>
                {{--</form>--}}
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('assets/js/admin/manager.js') }}"></script>
@include('common/footer')