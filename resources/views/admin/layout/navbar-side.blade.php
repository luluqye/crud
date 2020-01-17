<!-- Sidebar -->
<ul class="sidebar navbar-nav">
    <li class="nav-item {{($nav=='dashboard')?'active':''}}">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item {{($nav=='data')?'active':''}}">
        <a class="nav-link" href="{{route('admin.data.list')}}">
            <i class="fas fa-fw fa-list"></i>
            <span>Data</span></a>
    </li>
    <li class="nav-item {{($nav=='account')?'active':''}}">
        <a class="nav-link" href="{{route('admin.account.list')}}">
            <i class="fas fa-fw fa-user"></i>
            <span>Account</span></a>
    </li>
</ul>
