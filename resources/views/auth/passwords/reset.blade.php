<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Online Meeting | {{ __('home.Reset Password') }}</title>
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
            <div class="w-100 d-flex align-items-stretch auth auth-img-bg">

                <div class="card-body d-flex justify-content-center align-items-center flex-column"
                    style="background-color: rgba(191, 191, 191, 0.03) !important;">
                    @if (session('status'))
                    <div class="alert alert-success text-center" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div style="width:400px;">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="text-center">
                                        <h3><i class="fa fa-lock fa-4x"></i></h3>
                                        <h2 class="text-center"> {{ __('login.Forgot password?') }}</h2>
                                        <p>{{ __('admin.You can reset your password here.') }}</p>
                                        <div class="panel-body">

                                            <form method="POST" action="{{ route('password.update') }}">
                                                @csrf

                                                <input type="hidden" name="token" value="{{ $token }}">

                                                <div class="form-group mb-2">
                                                    <label for="email"
                                                        class="col-md-12 col-form-label pb-0 {{ (App::getLocale() == 'ar')? 'text-md-right pr-0' : 'text-md-left pl-0' }}">{{ __('admin.Email') }}</label>

                                                    <div class="input-group">
                                                        <div class="input-group-prepend bg-transparent">
                                                            <span style="border: 1px solid #000;"
                                                                class="input-group-text bg-transparent {{ (App::getLocale() == 'ar')? 'border-left-0' : 'border-right-0' }}">
                                                                <i class="mdi mdi-account-outline text-primary"></i>
                                                            </span>
                                                        </div>
                                                        <input type="email"
                                                            class="form-control {{ (App::getLocale() == 'ar')? 'border-right-0' : 'border-left-0' }} "
                                                            id="email" placeholder="{{ __('admin.Email') }}" value="{{ $email ?? old('email') }}" required autofocus
                                                            style="border: 1px solid #000;" name="email">

                                                    </div>
                                                    @if ($errors->has('email'))
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                    @endif

                                                </div>

                                                <div class="form-group mb-2">
                                                    <label for="password"
                                                        class="col-md-12 col-form-label pb-0 {{ (App::getLocale() == 'ar')? 'text-md-right pr-0' : 'text-md-left pl-0' }}">{{ __('admin.password') }}</label>

                                                    <div class="input-group">
                                                        <div class="input-group-prepend bg-transparent">
                                                            <span style="border: 1px solid #000;"
                                                                class="input-group-text bg-transparent {{ (App::getLocale() == 'ar')? 'border-left-0' : 'border-right-0' }}">
                                                                <i class="mdi mdi-lock-outline text-primary"></i>
                                                            </span>
                                                        </div>
                                                        <input type="password"  id="password" placeholder="{{ __('admin.password') }}" required
                                                            class="form-control {{ (App::getLocale() == 'ar')? 'border-right-0' : 'border-left-0' }} "
                                                            style="border: 1px solid #000;" name="password">

                                                    </div>
                                                    @if ($errors->has('password'))
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                    @endif

                                                </div>

                                                <div class="form-group mb-2">
                                                    <label for="password-confirm"
                                                        class="col-md-12 col-form-label pb-0 {{ (App::getLocale() == 'ar')? 'text-md-right pr-0' : 'text-md-left pl-0' }}">{{ __('admin.password_confirmation') }}</label>

                                                    <div class="input-group">
                                                        <div class="input-group-prepend bg-transparent">
                                                            <span style="border: 1px solid #000;"
                                                                class="input-group-text bg-transparent {{ (App::getLocale() == 'ar')? 'border-left-0' : 'border-right-0' }}">
                                                                <i class="mdi mdi-lock-outline text-primary"></i>
                                                            </span>
                                                        </div>
                                                        <input type="password"  id="password-confirm" placeholder="{{ __('admin.password_confirmation') }}" required
                                                            class="form-control {{ (App::getLocale() == 'ar')? 'border-right-0' : 'border-left-0' }} "
                                                            style="border: 1px solid #000;" name="password_confirmation">

                                                    </div>
                                                </div>

                                                <div class="form-group row mb-0 mt-4">
                                                    <div class="col-md-12 row justify-content-center">
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('home.Reset Password') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
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

