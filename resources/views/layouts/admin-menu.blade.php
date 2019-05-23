<!-- users -->
<li class="nav-item">
    <a class="nav-link" href="{{ url('users') }}">
        <i class="mdi mdi-account-multiple menu-icon"></i>
        <span class="menu-title">{{ __('admin.Users') }}</span>
    </a>
</li>

<!-- faculty -->
<li class="nav-item">
    <a class="nav-link" href="{{ url('faculty') }}">
        <i class="fas fa-graduation-cap menu-icon" style="font-size:0.9rem !important;"></i>
        <span class="menu-title">{{ __('admin.faculties') }}</span>
    </a>
</li>

<!-- Department -->
<li class="nav-item">
    <a class="nav-link" href="{{ url('department') }}">
        <i class="fas fa-server menu-icon {{ (App::getLocale() == 'ar')?'specialArabIcon':'specialIcon' }}"
            style="font-size:0.9rem !important;"></i>
        <span class="menu-title">{{ __('admin.Departments') }}</span>
    </a>
</li>

<!-- councilDefinition -->
<li class="nav-item">
    <a class="nav-link" href="{{ url('councilDefinition') }}" a>
        <i class="fas fa-clipboard-list menu-icon {{ (App::getLocale() == 'ar')?'specialArabIcon':'specialIcon' }}"
            style="font-size: 1rem !important;"></i>
        <span class="menu-title">{{ __('admin.Council Definitions') }}</span>
    </a>
</li>
