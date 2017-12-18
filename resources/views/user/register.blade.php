<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>后台管理系统</title>
    <link rel="shortcut icon" href="{{ asset('assets/ico/favicon.ico') }}" type="image/x-icon"/>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/jquery-ui/css/jquery-ui-1.10.4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/add-ons.min.css') }}" rel="stylesheet">
</head>
<body>
<div class="container-fluid content">
    <div class="row">
        <div id="content" class="col-sm-12 full">
            <div class="row">
                <div class="login-box">
                    <div class="header">
                        <h5 style="letter-spacing:5px;">用户注册</h5>
                    </div>
                    <form class="form-horizontal login" action="" method="post">
                        <fieldset class="col-sm-12">
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
                                    <div class="input-group col-sm-12">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input type="password" class="form-control" id="password"
                                               placeholder="请再次输入密码"/>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="controls row">
                                    <div class="input-group col-sm-6">
                                        <span class="input-group-addon"><i class="fa fa-code"></i></span>
                                        <input type="password" class="form-control" id="password"
                                               style="position: relative" placeholder="请输入验证码"/>
                                        <img src="{{captcha_src()}}" alt=""
                                             style="position: absolute; cursor: pointer;left:245px" onclick='this.src= "{{captcha_src()}}"+Math.random()'>
                                    </div>
                                </div>
                            </div>
                            <div class="confirm">
                                <input type="checkbox" name="remember"/>
                                <label for="remember">记住密码</label>
                            </div>
                            <div class="row">
                                <button type="submit" class="btn btn-lg btn-primary col-xs-12">登录</button>
                            </div>
                        </fieldset>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div><!--/row-->
        </div>
    </div><!--/row-->
</div><!--/container-->
</body>
</html>