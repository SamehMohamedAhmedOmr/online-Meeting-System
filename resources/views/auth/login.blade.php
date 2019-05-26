<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Online Meeting | {{ __('login.LOGIN') }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ URL::asset('library/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('library/base/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ URL::asset('library/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ URL::asset('images/favicon.png') }}" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/css/fileinput.min.css" media="all"
        rel="stylesheet" type="text/css" />

    @if (App::getLocale() == 'ar')
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.rtl.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/specialRTL.css') }}">
    @endif
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                <div class="row flex-grow">
                    <div class="col-lg-6 d-flex align-items-center justify-content-center">
                        <div class="auth-form-transparent {{ (App::getLocale() == 'ar')? 'text-right' : 'text-left' }} p-3">
                            <h4>{{ __('login.welcome') }}</h4>
                            <h6 class="font-weight-light">{{ __('login.Happy to see you again!') }}</h6>

                            <form class="pt-3" method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email">{{ __('admin.Email') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent {{ (App::getLocale() == 'ar')? 'border-left-0' : 'border-right-0' }}">
                                                <i class="mdi mdi-account-outline text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="email" class="form-control form-control-lg {{ (App::getLocale() == 'ar')? 'border-right-0' : 'border-left-0' }} {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                            id="email" placeholder="{{ __('admin.Email') }}" name="email">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <label for="password">{{ __('admin.password') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent {{ (App::getLocale() == 'ar')? 'border-left-0' : 'border-right-0' }} {{ $errors->has('password') ? 'is-invalid' : '' }}">
                                                <i class="mdi mdi-lock-outline text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="password" class="form-control form-control-lg {{ (App::getLocale() == 'ar')? 'border-right-0' : 'border-left-0' }}"
                                            id="password" placeholder="{{ __('admin.password') }}"  name="password">
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input" name="remember" id="remember">
                                            {{ __('login.Keep me signed in') }}
                                        </label>
                                    </div>
                                    <a href="{{ route('password.request') }}" class="auth-link text-black">
                                        {{ __('login.Forgot password?') }}
                                    </a>
                                </div>

                                <div class="my-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                       type="submit">{{ __('login.LOGIN') }}</a>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 login-half-bg d-flex flex-row">
                        <p class="text-white font-weight-medium text-center flex-grow align-self-end">{{ __('login.Copyright') }} &copy;
                            2019 {{ __('login.All rights reserved.') }}</p>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- plugins:js -->
    <script src="{{ URL::asset('library/base/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->

    <!-- inject:js -->
    <script src="{{ URL::asset('js/off-canvas.js') }}"></script>
    <script src="{{ URL::asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ URL::asset('js/template.js') }}"></script>
</body>
