<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('assets/img/avatar3.png')}}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>Hello, {{ auth()->user()->first_name}} {{auth()->user()->last_name }}</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="{{ Request::route()->getName() ==  'dashboard.index' ? 'active' : '' }}">
                <a href="{{route('dashboard.index')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="treeview {{ Request::route()->getName() == 'dashboard.get-all-customers' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Customers</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('dashboard.get-all-customers')}}"><i class="fa fa-angle-double-right"></i> Customers List</a></li>
                    <li><a href="{{route('dashboard.get-all-doctors')}}"><i class="fa fa-angle-double-right"></i> Doctors List</a></li>
                </ul>
            </li>

            <li class="treeview {{ Request::route()->getName() == '' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-stack-overflow"></i>
                    <span>Inquiry</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('dashboard.get-stock-overview')}}"><i class="fa fa-angle-double-right"></i> Stock Overview</a></li>
                    <li><a ><i class="fa fa-angle-double-right"></i> Item Inquiry</a></li>
                </ul>
            </li>

            <li class="treeview {{ (Request::route()->getName() == 'dashboard.get-all-products') || (Request::route()->getName() == 'dashboard.get-all-categories') || (Request::route()->getName() == 'dashboard.get-all-brands') || (Request::route()->getName() == 'dashboard.get-all-models') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-trello"></i>
                    <span>Manage Products</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('dashboard.get-all-products')}}"><i class="fa fa-angle-double-right"></i> Products</a></li>
                    <li><a href="{{route('dashboard.get-all-categories')}}"><i class="fa fa-angle-double-right"></i> Categories</a></li>
                    <li><a href="{{route('dashboard.get-all-brands')}}"><i class="fa fa-angle-double-right"></i> Brands</a></li>
                    <li><a href="{{route('dashboard.get-all-models')}}"><i class="fa fa-angle-double-right"></i> Models</a></li>
                </ul>
            </li>

            <li class="{{ Request::route()->getName() == 'dashboard.get-all-branches' ? 'active' : '' }}">
                <a href="{{route('dashboard.get-all-branches')}}">
                    <i class="fa fa-sitemap"></i> <span>Branches</span>
                </a>
            </li>

            @if(auth()->user()->hasPermission('read_users'))
                <li class="{{ Request::route()->getName() == 'dashboard.get-all-users' ? 'active' : '' }}">
                    <a href="{{route('dashboard.get-all-users')}}">
                        <i class="fa fa-user"></i> <span>Users</span>
                    </a>
                </li>
            @endif

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
