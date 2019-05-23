<!-- Ranks -->
<li class="nav-item">
    <a class="nav-link" href="{{ url('rank') }}">
        <i class="fas fa-id-badge menu-icon {{ (App::getLocale() == 'ar')?'specialArabIcon':'specialIcon' }}"
            style="font-size: 1rem !important;"></i>
    <span class="menu-title">{{__("Staff.Ranks")}}</span>
    </a>
</li>

<!-- positions -->
<li class="nav-item">
    <a class="nav-link" href="{{ url('position') }}">
        <i class="fas fa-user-tie menu-icon {{ (App::getLocale() == 'ar')?'specialArabIcon':'specialIcon' }}"
            style="font-size: 1rem !important;"></i>
        <span class="menu-title">{{__("Staff.Positions")}}</span>
    </a>
</li>

<!-- subjectType -->
<li class="nav-item">
    <a class="nav-link" href="{{ url('subjectType') }}">
        <i class="mdi mdi-book-open-page-variant menu-icon"></i>
        <span class="menu-title">{{__("home.Subject")}}</span>
    </a>
</li>

<!-- councilDefinition -->
<li class="nav-item">
    <a class="nav-link" href="{{ url('councilDefinition') }}" a>
        <i class="fas fa-clipboard-list menu-icon {{ (App::getLocale() == 'ar')?'specialArabIcon':'specialIcon' }}"
            style="font-size: 1rem !important;"></i>
        <span class="menu-title">{{__("Staff.Councildefinitions")}}</span>
    </a>
</li>

<!-- Setup Meeting -->
<li class="nav-item">
    <a class="nav-link" href="{{ url('meeting') }}">
        <i class="fas fa-handshake menu-icon {{ (App::getLocale() == 'ar')?'specialArabIcon':'specialIcon' }}"
            style="font-size: 1rem !important;"></i>
        <span class="menu-title">{{__("home.Meeting")}}</span>
    </a>
</li>
