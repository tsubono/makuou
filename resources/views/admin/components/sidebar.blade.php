<section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">基本機能</li>
        <li class="{{ request()->is('admin') ? 'active' : '' }}">
            <a href="{{ url('/admin') }}">
                <i class="fa fa-home"></i>
                <span>ホーム</span>
            </a>
        </li>
        <li class="{{ request()->is('admin/products', 'admin/products/*', 'admin/product-categories', 'admin/product-categories/*') ? 'active' : '' }} treeview">
            <a href="#">
                <i class="fa fa-tag"></i>
                <span>テンプレート管理</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ request()->is('admin/products') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/products') }}">
                        <span>テンプレート一覧</span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/products/create') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/products/create') }}">
                        <span>テンプレート登録</span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/product-categories', 'admin/product-categories/*') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/product-categories') }}">
                        <span>テンプレートカテゴリー</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="{{ request()->is('admin/stamps', 'admin/stamps/*', 'admin/stamp-categories', 'admin/stamp-categories/*') ? 'active' : '' }} treeview">
            <a href="#">
                <i class="fa fa-shirtsinbulk"></i>
                <span>スタンプ管理</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ request()->is('admin/stamps') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/stamps') }}">
                        <span>スタンプ一覧</span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/stamps/create') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/stamps/create') }}">
                        <span>スタンプ登録</span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/stamp-categories', 'admin/stamp-categories/*') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/stamp-categories') }}"><span>スタンプカテゴリー一覧</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="{{ request()->is('admin/orders', 'admin/orders/*') ? 'active' : '' }} treeview">
            <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>受注管理</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ request()->is('admin/orders') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/orders') }}">
                        <span>受注一覧</span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/orders/create') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/orders/create') }}">
                        <span>受注登録</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="{{ request()->is('admin/users', 'admin/users/*') ? 'active' : '' }} treeview">
            <a href="#">
                <i class="fa fa-users"></i>
                <span>会員管理</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ request()->is('admin/users') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/users') }}">
                        <span>会員一覧</span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/users/create') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/users/create') }}">
                        <span>会員登録</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="{{ request()->is('admin/news', 'admin/news/*') ? 'active' : '' }} treeview">
            <a href="#">
                <i class="fa fa-comment"></i>
                <span>新着情報管理</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ request()->is('admin/news') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/news') }}">
                        <span>新着情報一覧</span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/news/create') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/news/create') }}">
                        <span>新着情報登録</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="header">設定</li>
        <li class="{{ request()->is('admin/product-setting', 'admin/product-setting/*') ? 'active' : '' }} treeview">
            <a href="#">
                <i class="fa fa-cog"></i>
                <span>商品設定</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ request()->is('admin/product-setting/prices') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/product-setting/prices') }}">
                        <span>値段管理</span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/product-setting/sizes') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/product-setting/sizes') }}">
                        <span>サイズマスタ管理</span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/product-setting/ratios') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/product-setting/ratios') }}">
                        <span>比率マスタ管理</span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/product-setting/clothes') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/product-setting/clothes') }}">
                        <span>生地マスタ管理</span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/product-setting/options') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/product-setting/options') }}">
                        <span>仕上げオプションマスタ管理</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="{{ request()->is('admin/setting', 'admin/setting/*') ? 'active' : '' }} treeview">
            <a href="#">
                <i class="fa fa-cog"></i>
                <span>ショップ設定</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ request()->is('admin/setting/shop') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/setting/shop') }}">
                        <span>ショップ情報管理</span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/setting/tradelaw') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/setting/tradelaw') }}">
                        <span>特定商取引法管理</span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/setting/customer-agreement') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/setting/customer-agreement') }}">
                        <span>利用規約管理</span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/setting/payments') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/setting/payments') }}">
                        <span>支払い方法管理</span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/setting/mail-templates') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/setting/mail-templates') }}">
                        <span>メール設定管理</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="{{ request()->is('admin/admins', 'admin/admins/*') ? 'active' : '' }} treeview">
            <a href="#">
                <i class="fa fa-key"></i>
                <span>管理スタッフ管理</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ request()->is('admin/admins') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/admins') }}">
                        <span>管理スタッフ一覧</span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/admins/create') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/admins/create') }}">
                        <span>管理スタッフ登録</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="{{ url('/admin/logout') }}">
                <i class="fa fa-sign-out"></i>
                <span>ログアウト</span>
            </a>
        </li>
    </ul>
</section>
