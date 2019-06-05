    <!-- partial:partials/_navbar.html -->
    <style>
        .notification {
            position: absolute;
            top: 0px;
            right: -10px;
            padding: 3px 3px;
            border-radius: 50%;
            background-color: red;
            color: white;
            height: 20px;
            width: 20px;
            line-height: 17px;
        }

        .navbar .navbar-menu-wrapper .navbar-nav .nav-item.nav-profile .nav-link .nav-profile-name {
            position: relative !important;
            top: 2px !important;
        }

        .account-icons {
            font-size: 1.2rem;
            position: relative;
            top: 1px;
        }

        .search-area {
            max-height: 480px;
            background: #fff;
            right: 0;
            left: 0;
            padding: 10px;
            box-shadow: 0px 3px 21px 0px rgba(0, 0, 0, 0.2);
        }

        .search-area li {
            padding: 10px 10px 0px 10px;
            color: #000;
        }

        .search-area li a {
            text-decoration: none;
            color: #000;
        }

        .search-area li:hover {
            background-color: #f9f8f8;
            cursor: pointer;
        }

        @media (max-width: 991px) {
            .navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .navbar-dropdown {
                right: 20px !important;
            }
        }

    </style>
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="position:fixed !important;">
        <div class="navbar-brand-wrapper d-flex justify-content-center">
            <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                <a class="navbar-brand brand-logo" href="{{ url('dashboard') }}">
                    <img src="{{ URL::asset('images/logo.svg') }}" alt="logo" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="{{ url('dashboard') }}">
                    <img src="{{ URL::asset('images/logo-mini.svg') }}" alt="logo" />
                </a>
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-sort-variant"></span>
                </button>
            </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <ul class="navbar-nav mr-lg-4 w-100">
                <li class="nav-item nav-search d-none d-lg-block w-100 position-relative" id="sea">
                    <div class="input-group">
                        <div class="input-group-prepend search-icon">
                            <span class="input-group-text" id="search">
                                <i class="mdi mdi-magnify"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="searchy" placeholder="{{ __('home.Search now') }}"
                            aria-label="search" aria-describedby="search" autocomplete="off">
                    </div>
                    <div
                        class="search-area position-absolute d-none {{ (App::getLocale() == 'ar') ? 'text-right' : 'text-left' }}">
                        <h6 class="mt-2 mb-3" style="color:#000;">{{ __('home.result') }}</h6>
                        <ul class="list-unstyled m-0 p-0" style="border: 1px solid #ccc;">
                            <li style="color:#000;">{{ __('home.Enter To Search') }}</li>
                        </ul>
                    </div>
            </ul>

            <ul class="navbar-nav navbar-nav-right">

                <li class="nav-item dropdown mr-4">
                    <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
                        id="langDropDown" href="#" data-toggle="dropdown">
                        <i class="mdi mdi-earth mx-0"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="langDropDown">
                        <p class="mb-0 font-weight-normal float-left dropdown-header">{{ __('home.Langauge') }}</p>
                        <a class="dropdown-item" href="{{ url('setlocale/ar') }}">
                            <div class="item-thumbnail">
                                <img src="{{ URL::asset('images/flags/arabic.png') }}" alt="image" class="profile-pic">
                            </div>
                            <div class="item-content flex-grow">
                                <h6 class="font-weight-normal" style="margin-top: 0.5rem;">
                                    {{ __('home.Arabic') }}
                                </h6>
                            </div>
                        </a>
                        <a class="dropdown-item" href="{{ url('setlocale/en') }}">
                            <div class="item-thumbnail">
                                <img src="{{ URL::asset('images/flags/english.jpg') }}" alt="image" class="profile-pic">
                            </div>
                            <div class="item-content flex-grow">
                                <h6 class="font-weight-normal" style="margin-top: 0.5rem;">
                                    {{ __('home.English') }}
                                </h6>
                            </div>
                        </a>
                    </div>
                </li>

                <li class="nav-item dropdown mr-4">
                    <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown"
                        id="notificationDropdown" href="#" data-toggle="dropdown" onclick="zero()">
                        @php
                        $notification = \App\Notification::where('user_id',
                        Auth::user()->id)->where('watch',0)->count();
                        @endphp
                        <span class="notification" id="number"
                            {{ ($notification == 0)?'hidden':'' }}>{{ $notification }}</span>
                        <i class="mdi mdi-bell mx-0" id="bell">

                        </i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                        aria-labelledby="notificationDropdown" id="maxy"
                        style="{{ (App::getLocale() == 'ar')? 'right: auto; left: 0 !important;' : '' }} overflow-y: auto; max-height: 480px;">
                        <p class="mb-0 font-weight-normal float-left dropdown-header" id='notificationHeader'>
                            {{ __('home.Notification') }}
                        </p>

                        @foreach ($data as $item)
                        @if($item->seen=='0')
                        <a class="dropdown-item" style="background-color: #E9EBEE;  border-bottom: 1px solid #dadada;"
                            href="{{ url(''.$item->page.'') }}" id="max{{$item->id}}" value="{{$item->id}}">
                            <div class="item-thumbnail">
                                <div class="item-icon {{ $item->color }}">
                                    <i class="{{ $item->icon }} mx-0"></i>
                                </div>
                            </div>
                            <div class="item-content">
                                <h6 class="font-weight-normal">
                                    @if (App::getLocale() == 'ar')
                                    {{$item->title_ar}}
                                    @else
                                    {{$item->title}}
                                    @endif
                                </h6>
                                <p class="font-weight-light small-text mb-0 text-muted">
                                    @if (App::getLocale() == 'ar')
                                    {{$item->notify_ar}}
                                    @else
                                    {{$item->notify}}
                                    @endif
                                </p>
                                <p class="font-weight-light small-text mb-0 text-muted" style="font-size:0.8em;">
                                    {{$item->created_at}}
                                </p>

                            </div>
                        </a>
                        @else
                        <a class="dropdown-item card-body" style="border-bottom: 1px solid #dadada;"
                            href="{{ url(''.$item->page.'') }}" id="max{{$item->id}}" value="{{$item->id}}">
                            <div class="item-thumbnail">
                                <div class="item-icon {{ $item->color }}">
                                    <i class="{{ $item->icon }} mx-0"></i>
                                </div>
                            </div>
                            <div class="item-content">
                                <h6 class="font-weight-normal">{{$item->title}}</h6>
                                <p class="font-weight-light small-text mb-0 text-muted">
                                    {{$item->notify}}
                                </p>
                                <p class="font-weight-light small-text mb-0 text-muted" style="font-size:0.8em;">
                                    {{$item->created_at}}
                                </p>

                            </div>
                        </a>
                        @endif
                        @endforeach

                        @if (count($data) == 0)
                        <a class="dropdown-item" id='no-notification'
                            style="background-color: #E9EBEE;  border-bottom: 1px solid #dadada;">
                            <div class="item-content">
                                <h6 class="font-weight-normal" style="margin-top: 0.5rem;">
                                    No Notification Yet
                                </h6>
                            </div>
                        </a>
                        @endif
                    </div>
                </li>

                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                        @if (Auth::user()->image == 'default_default.png')
                        <img src="{{ URL::asset('storage/user_pic/default/'.Auth::user()->image) }}" alt="profile">
                        @else
                        <img src="{{ URL::asset('storage/user_pic/'.Auth::user()->id.'/'.Auth::user()->image) }}"
                            alt="profile">
                        @endif
                        <span class="nav-profile-name">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" data-toggle="modal" data-target="#modalRelatedContent">
                            <i class="mdi mdi-account-circle text-primary account-icons"></i>
                            {{ __('home.profile') }}
                        </a>
                        {{-- <a class="dropdown-item">
                            <i class="mdi mdi-settings text-primary account-icons"></i>
                            {{ __('home.setting') }}
                        </a> --}}
                        <a class="dropdown-item" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-logout text-primary account-icons"></i>
                            {{ __('home.Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>

            </ul>

            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>

        </div>
    </nav>
    <!-- Button trigger modal-->


<!-- profile Modal -->
<div class="modal fade" id="modalRelatedContent" tabindex="-1" role="dialog" aria-labelledby="profile"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center justify-content-center">
                    <h4 class="modal-title" id="myModalLabel">{{__("home.profile")}}</h4>
                </div>
                <div class="modal-body">
                        <div class="d-flex justify-content-center flex-column align-items-center">
                                @if(Auth::user()->image!='default_default.png')
                                <img src="{{ URL::asset('storage/user_pic/'.Auth::user()->id.'/'.Auth::user()->image) }}"
                                    name="aboutme" width="140" height="140" class="img-circle faculty_logo"></a>
                                @else
                                <img src="{{ URL::asset('storage/user_pic/default/default_default.png') }}" name="aboutme"
                                    width="140" height="140" class="img-circle faculty_logo"></a>
                                @endif
                                <br>
                                <h3 class="media-heading">{{$profile->name}}</h3>
                                <span class="mb-2"><strong>{{__("admin.Email")}}: </strong></span>
                                <span class="label label-warning mb-2">{{$profile->email}}</span>

                        </div>

                        <div class="d-flex justify-content-center">
                                    <p><strong>{{__("home.job")}}: </strong>
                                    @if($profile->type==0)
                                    <span class="label label-warning">{{__("home.Admin")}}</span>
                                    @elseif($profile->type==1)
                                    <span class="label label-warning">{{__("home.Staff")}}</span>
                                    @else
                                    <span class="label label-warning">{{__("home.Council Member")}}</span>
                                    @endif
                                    <br>
                        </div>
                </div>
            </div>
        </div>
    </div>
