   <nav class="sidebar sidebar-offcanvas" id="sidebar">
       <ul class="nav">

           <li class="nav-item">
               <a class="nav-link" href="{{ url('dashboard') }}">
                   <i class="mdi mdi-home menu-icon"></i>
                   <span class="menu-title">{{ __('home.Dashboard') }}</span>
               </a>
           </li>

           @if(Auth::user()->type ==0)
           <!-- Admin links -->

           @include('layouts.admin-menu')

           @elseif(Auth::user()->type ==1)
           <!-- staff links -->

           @include('layouts.staff-menu')

           @elseif(Auth::user()->type ==2)
           <!-- member links -->
           @include('layouts.member-menu')
           @endif

           {{-- @include('layouts.temporal') --}}

       </ul>
   </nav>
