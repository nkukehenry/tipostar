<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{route('home')}}">
                    <i class="fa fa-home"></i> <span>Home</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.dashboard')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{route('matches.index')}}">
                    <i class="fa fa-soccer-ball-o"></i> <span>Matches</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.users')}}">
                    <i class="fa fa-user"></i> <span>Users</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.countries')}}">
                    <i class="fa fa-flag"></i> <span>Countries</span>
                </a>
            </li>
            <li>
                <a href="{{route('leagues.index')}}">
                    <i class="fa fa-trophy"></i> <span>Leagues</span>
                </a>
            </li>
            <li>
                <a href="{{route('teams.index')}}">
                    <i class="fa fa-users"></i> <span>Teams</span>
                </a>
            </li>
            <li>
                <a href="{{route('odds.index')}}">
                    <i class="fa fa-bar-chart"></i> <span>Outcomes</span>
                </a>
            </li>
             <li>
                <a href="{{route('plans.index')}}">
                    <i class="fa fa-bar-chart"></i> <span>Plans</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
