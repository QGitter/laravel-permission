
@include('common/header')
<body>
<div class="container-fluid content">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body" style="border-bottom: none">
                <div class="alerts" id="alerts">
                    <div class="alert alert-success">
                        <i class="fa fa-check-circle"></i>&nbsp;&nbsp;请修改管理员信息
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon whitetext textright">用户名：</span>
                        <input id="username" name="username" class="form-control" disabled value="<?php echo !empty($username) ? $username : ""?>" type="text" >
                        <span class="input-group-addon whitetext"><font color="red">*</font></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon whitetext textright">旧密码：</span>
                        <input id="oldpassword" name="oldpassword" class="form-control" placeholder="请输入旧密码" value="" type="password">
                        <span class="input-group-addon whitetext"><font color="red">*</font></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon whitetext textright">新密码：</span>
                        <input id="newpassword" name="newpassword" class="form-control" placeholder="请输入新密码" value="" type="password">
                        <span class="input-group-addon whitetext"><font color="red">*</font></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon whitetext textright">重复密码：</span>
                        <input id="repeatpassword" name="repeatpassword" class="form-control" placeholder="请再次输入新密码" value="" type="password">
                        <span class="input-group-addon whitetext"><font color="red">*</font></span>
                    </div>
                </div>

                <div class="form-group form-actions pull-right">
                    {{csrf_field()}}
                    <button type="button" class="btn  btn-success" onclick="confirmEditPassword()"> 确定</button>
                    <button type="button" class="btn  btn-default" onclick="cancelEditPassword()"> 取消</button>
                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('assets/js/admin/manager.js') }}"></script>
@include('common/footer')