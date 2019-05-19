    <!-- partial:partials/_navbar.html -->
    <style>
        .notification {
            position: absolute;
            top: 0px;
            right: -5px;
            padding: 3px 3px;
            border-radius: 50%;
            background-color: red;
            color: white;
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
                <li class="nav-item nav-search d-none d-lg-block w-100">
                    <div class="input-group">
                        <div class="input-group-prepend search-icon">
                            <span class="input-group-text" id="search">
                                <i class="mdi mdi-magnify"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" placeholder="Search now" aria-label="search"
                            aria-describedby="search">
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item dropdown mr-4">
                    <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
                        id="langDropDown" href="#" data-toggle="dropdown">
                        <i class="mdi mdi-earth mx-0"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="langDropDown">
                        <p class="mb-0 font-weight-normal float-left dropdown-header">Langauge</p>
                        <a class="dropdown-item" href="{{ url('setlocale/ar') }}">
                            <div class="item-thumbnail">
                                <img src="{{ URL::asset('images/flags/arabic.png') }}" alt="image" class="profile-pic">
                            </div>
                            <div class="item-content flex-grow">
                                <h6 class="font-weight-normal">
                                    Arabic
                                </h6>
                            </div>
                        </a>
                        <a class="dropdown-item" href="{{ url('setlocale/en') }}">
                            <div class="item-thumbnail">
                                <img src="{{ URL::asset('images/flags/english.jpg') }}" alt="image" class="profile-pic">
                            </div>
                            <div class="item-content flex-grow">
                                <h6 class="font-weight-normal">
                                    English
                                </h6>
                            </div>
                        </a>
                    </div>
                </li>

                <li class="nav-item dropdown mr-4">
                    <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
                        id="messageDropdown" href="#" data-toggle="dropdown">
                        <i class="mdi mdi-message-text mx-0"></i>
                        <span class="count"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown">
                        <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                        <a class="dropdown-item">
                            <div class="item-thumbnail">
                                <img src="{{ URL::asset('images/faces/face4.jpg') }}" alt="image" class="profile-pic">
                            </div>
                            <div class="item-content flex-grow">
                                <h6 class="ellipsis font-weight-normal">David Grey
                                </h6>
                                <p class="font-weight-light small-text text-muted mb-0">
                                    The meeting is cancelled
                                </p>
                            </div>
                        </a>
                        <a class="dropdown-item">
                            <div class="item-thumbnail">
                                <img src="{{ URL::asset('images/faces/face2.jpg') }}" alt="image" class="profile-pic">
                            </div>
                            <div class="item-content flex-grow">
                                <h6 class="ellipsis font-weight-normal">Tim Cook
                                </h6>
                                <p class="font-weight-light small-text text-muted mb-0">
                                    New product launch
                                </p>
                            </div>
                        </a>
                        <a class="dropdown-item">
                            <div class="item-thumbnail">
                                <img src="{{ URL::asset('images/faces/face3.jpg') }}" alt="image" class="profile-pic">
                            </div>
                            <div class="item-content flex-grow">
                                <h6 class="ellipsis font-weight-normal"> Johnson
                                </h6>
                                <p class="font-weight-light small-text text-muted mb-0">
                                    Upcoming board meeting
                                </p>
                            </div>
                        </a>
                    </div>
                </li>


                <li class="nav-item dropdown mr-4">
                    <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown"
                        id="notificationDropdown" href="#" data-toggle="dropdown">
                        <span class="notification" id="number" hidden>0</span>
                        <i class="mdi mdi-bell mx-0" onclick="zero()" id="bell">

                        </i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                        aria-labelledby="notificationDropdown" id="maxy">
                        <p class="mb-0 font-weight-normal float-left dropdown-header">Notification</p>

                            @foreach ($data as $item)
                                @if($item->seen=='0')
                                    <a class="dropdown-item" style="background-color: #E9EBEE;  border-bottom: 1px solid #dadada;" href="{{ url(''.$item->page.'') }}"
                                        id="max{{$item->id}}" value="{{$item->id}}">
                                        <div class="item-thumbnail">
                                            <div class="item-icon bg-success">
                                                <i class="mdi mdi-information mx-0"></i>
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
                                @else
                                    <a class="dropdown-item card-body" style="border-bottom: 1px solid #dadada;" href="{{ url(''.$item->page.'') }}" id="max{{$item->id}}"
                                        value="{{$item->id}}">
                                        <div class="item-thumbnail">
                                            <div class="item-icon bg-success">
                                                <i class="mdi mdi-information mx-0"></i>
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
                    </div>
                </li>

                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                        <img src="{{ URL::asset('storage/user_pic/'.Auth::user()->id.'/'.Auth::user()->image) }}"
                            alt="profile">
                        <span class="nav-profile-name">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item">
                            <i class="mdi mdi-settings text-primary"></i>
                            Settings
                        </a>
                        <a class="dropdown-item" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-logout text-primary"></i>
                            Logout
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

