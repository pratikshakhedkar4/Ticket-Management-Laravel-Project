<nav class="main-header navbar navbar-expand navbar-white navbar-light">

<!-- Left navbar links -->
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
</ul>
<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">

    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-user-cog mr-1"></i>
        </a>
        <div class="dropdown-menu dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="logout();"><i class="fas fa-sign-out-alt mr-2"></i>Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </li>
</ul>
</nav>