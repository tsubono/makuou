<!-- ロゴ -->
<a href="{{ url('/admin') }}" class="logo">
    <span class="logo-mini"><b>幕</b>王</span>
    <span class="logo-lg"><b>幕王</b>管理画面</span>
</a>
<nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="hidden-xs">{{\Auth::user()->name}}</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- Menu Body -->
                    <li class="user-body">
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <a href="{{ url('/admin/admins/'. \Auth::user()->id. '/edit') }}" class="btn btn-primary btn-flat">スタッフ情報変更</a>
                            </div>
                            <div class="col-xs-12 text-center mt-10">
                                <a href="{{ url('/admin/logout') }}" class="btn btn-primary btn-flat">ログアウト</a>
                            </div>
                        </div>
                        <!-- /.row -->
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>