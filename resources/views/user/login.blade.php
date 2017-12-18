@include('common/header')
<body>
<div class="container-fluid content">
    <div class="row">
        <div id="content" class="col-sm-12 full">
            <div class="row">
                <div class="login-box">
                    <div class="header">
                        <h5 style="letter-spacing:5px;">管理系统</h5>
                    </div>
                    <div class="form-horizontal login">
                        <fieldset class="col-sm-12">
                            <div class="form-group">
                                <div class="controls row">
                                    <div class="input-group col-sm-12">
                                        <div class="alerts" id="alerts">
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="form-group">
                                <div class="controls row">
                                    <div class="input-group col-sm-12">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" id="username" placeholder="请输入用户名或邮箱"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="controls row">
                                    <div class="input-group col-sm-12">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input type="password" class="form-control" id="password" placeholder="请输入密码"/>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="controls row">
                                    <div class="input-group col-sm-6">
                                        <span class="input-group-addon"><i class="fa fa-code"></i></span>
                                        <input type="text" class="form-control" id="captcha"
                                               style="position: relative" placeholder="请输入验证码"/>
                                        <img src="{{captcha_src()}}" alt="" id="captchasrc"
                                             style="position: absolute; cursor: pointer;left:245px" onclick='this.src= "{{captcha_src()}}"+Math.random()'>
                                    </div>
                                </div>
                            </div>
  {{--                          <div class="confirm">
                                <input type="checkbox" name="remember" id="remember" value="1"/>
                                <label for="remember">记住密码</label>
                            </div>--}}
                            <div class="row">
                                {{csrf_field()}}
                                <button type="button" class="btn btn-lg btn-primary col-xs-12" onclick="toLogin()">登录</button>
                            </div>
                        </fieldset>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div><!--/row-->
        </div>
    </div><!--/row-->
</div><!--/container-->

<script type="text/javascript">
    $(document).ready(function () {
        $(document).keydown(function (event) {
            if (event.keyCode == 13){
                toLogin();
            }
        })
    })
    function toLogin() {
        var captcha = $.trim($("#captcha").val())
        var username = $.trim($("#username").val())
        var password = $.trim($("#password").val());
        var data ={};
        var alertMsg = "";

        if(username == ""){
            alertMsg = "管理员账号不能为空";
            showMsg("alerts",failMsg(alertMsg));
            return;
        }
        data.username = username;
        if(password == ""){
            alertMsg = "密码不能为空";
            showMsg("alerts",failMsg(alertMsg));
            return;
        }
        data.password = password;
        if(captcha == ""){
            alertMsg = "验证码不能为空";
            showMsg("alerts",failMsg(alertMsg));
            return;
        }
        data.captcha = captcha;

        $.ajax({
            url: "/",
            type: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            ContentType: "application/json; charset=utf-8",
            data: data,
            success:function(result){
                if(result.code==0){
                   window.location.href="/main";
                }else{
                    $("#captchasrc").prop("src","{{ captcha_src() }}"+Math.random());
                    showMsg("alerts",failMsg(result.msg));
                }
            }
        });
    }
</script>
</body>
</html>