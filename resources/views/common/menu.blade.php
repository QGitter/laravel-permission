<!-- start: Main Menu -->
<div class="sidebar ">
    <div class="sidebar-collapse">
        <div class="sidebar-header t-center" style="font-size: 28px;line-height: 60px;letter-spacing: 10px">
            ADMIN
 {{--           <span>
                <img class="text-logo" src="{{ asset('assets/img/logo1.png') }}">
                <i class="fa fa-space-shuttle fa-3x blue"></i>
            </span>--}}
        </div>
        <div class="sidebar-menu">
            <ul class="nav nav-sidebar">
                <li><a href="/main"><i class="fa fa-laptop"></i><span class="text"> 首页</span></a></li>
                {!! $menuslist !!}
            </ul>
        </div>
    </div>
    <div class="sidebar-footer"></div>
</div>
<!-- end: Main Menu -->