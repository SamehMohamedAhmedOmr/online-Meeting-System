<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Majestic Admin</title>
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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

    @if (App::getLocale() == 'ar')
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.rtl.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/specialRTL.css') }}">
    @endif

    @yield('styles')

    <style>
        .whole-page-overlay{
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            position: fixed;
            background: rgb(226, 227, 228 ,0.8);
            width: 100%;
            height: 100% !important;
            z-index: 1050;
        }
        .whole-page-overlay div{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: inherit;
        }
        .whole-page-overlay .center-loader{
            color: white;
            margin: 20px;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        @include('layouts.navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">

            @include('layouts.side-menu')

            {{--start content--}}
            @yield('content')
            {{--end content--}}

        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <div class="whole-page-overlay" id="whole_page_loader">
        <div>
            <h2 style="color:#d35400;">Online Meeting System</h2>
            <img class="center-loader"  style="height:100px;" src="{{ URL::asset('images/loader.gif') }}"/>
            <p style="color: #c0392b;">please Wait</p>
        </div>
    </div>
    <!-- container-scroller -->

    @include('layouts.scripts')

    <script>
        $(function(){
            $( window ).on("load",function(){
                $('.whole-page-overlay').slideUp();
            });
        })
    </script>
</body>

</html>
