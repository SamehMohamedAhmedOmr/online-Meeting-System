<!-- users -->
<li class="nav-item">
    <a class="nav-link" href="{{ url('users') }}">
        <i class="mdi mdi-account-multiple menu-icon"></i>
        <span class="menu-title">Users</span>
    </a>
</li>

<!-- faculty -->
<li class="nav-item">
    <a class="nav-link" href="{{ url('faculty') }}">
        <i class="fas fa-graduation-cap menu-icon" style="font-size:0.9rem !important;"></i>
        <span class="menu-title">faculties</span>
    </a>
</li>

<!-- Department -->
<li class="nav-item">
    <a class="nav-link" href="{{ url('department') }}">
        <i class="fas fa-server menu-icon {{ (App::getLocale() == 'ar')?'specialArabIcon':'specialIcon' }}"
            style="font-size:0.9rem !important;"></i>
        <span class="menu-title">Departments</span>
    </a>
</li>
