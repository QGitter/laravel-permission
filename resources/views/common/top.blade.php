<!-- start: Header -->
<div class="navbar" role="navigation">
    <div class="container-fluid">
        <ul class="nav navbar-nav navbar-actions navbar-left">
            <li class="visible-md visible-lg"><a href="javascript:;" id="main-menu-toggle"><i class="fa fa-th-large"></i></a></li>
            <li class="visible-xs visible-sm"><a href="/main" id="sidebar-menu"><i class="fa fa-navicon"></i></a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown visible-md visible-lg">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img class="user-avatar" src="{{ asset('assets/img/avatar.jpg') }}" alt="user-mail">
                    {{ session('userinfo.username') }} &nbsp;&nbsp;
                </a>
                <ul class="dropdown-menu">
                    <li><a href="javascript:;" onclick="editPassword({{ session('userinfo.id') }});"><i class="fa fa-user"></i> 修改密码</a></li>
                    <li><a href="/logout"><i class="fa fa-sign-out"></i> 退出登录</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<script type="text/javascript">
    function editPassword(id) {
        layer.open({
            type: 2,
            title: '修改密码',
            maxmin: true,
            area: ['600px', '400px'],
            content: '/editpassword?id='+id
        });
    }
</script>
<!-- end: Header -->