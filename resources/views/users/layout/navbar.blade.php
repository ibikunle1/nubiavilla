<div class="navbar-bg"></div>

<!-- Start app top navbar -->
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>

    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user"> 
            @if(auth()->user()->profile) 
               <img alt="image" src="{{asset('assets/picture/'.auth()->user()->profile)}}" class="rounded-circle mr-1" style="height:40px;width:40px"> 
            @else 
              <img alt="image" src="{{asset('assets/img_avatar3.png')}}" class="rounded-circle mr-1"> 
            @endif
            <div class="d-sm-none d-lg-inline-block">Hi, {{ ucwords(Auth::user()->name) }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{route('home')}}" class="dropdown-item"> <i class="fas fa-user mr-2"></i> {{ _('Profile')}} </a>
                 <div class="dropdown-divider"></div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" class="dropdown-item has-icon text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </li>
    </ul>
</nav>

<!-- Start main left sidebar menu -->
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="">NubiaVilla</a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown  {{ Request::is('home*') ? 'active' : '' }}">
                <a href="{{url('/home')}}" class="nav-link"><i class="fa fa-home"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown  {{ Request::is('expenses*') ? 'active' : '' }}">
                <a href="{{ route('expenses.index')}}" class="nav-link"><i class="fas fa-money-bill"></i><span>Expenses</span></a>
            </li> 
            <li class="dropdown  {{ Request::is('file-import*') ? 'active' : '' }}">
                <a href="{{ url('/file-import')}}" class="nav-link"><i class="fas fa-file-import"></i><span>Import</span></a>
            </li>                       
            


             </ul>

    </aside>
</div>
