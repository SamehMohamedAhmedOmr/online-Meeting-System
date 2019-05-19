<!-- plugins:js -->
<script src="{{ URL::asset('library/base/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<script src="{{ URL::asset('library/chart.js/Chart.min.js') }}"></script>
<script src="{{ URL::asset('library/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('library/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{ URL::asset('js/off-canvas.js') }}"></script>
<script src="{{ URL::asset('js/hoverable-collapse.js') }}"></script>
<script src="{{ URL::asset('js/template.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{ URL::asset('js/dashboard.js') }}"></script>
<script src="{{ URL::asset('js/data-table.js') }}"></script>
<script src="{{ URL::asset('js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('js/dataTables.bootstrap4.js') }}"></script>
<!-- End custom js for this page-->

<!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
    wish to resize images before upload. This must be loaded before fileinput.min.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.2/js/plugins/piexif.min.js"
    type="text/javascript"></script>
<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
        This must be loaded before fileinput.min.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.2/js/plugins/sortable.min.js"
    type="text/javascript"></script>
<!-- purify.min.js is only needed if you wish to purify HTML content in your preview for
        HTML files. This must be loaded before fileinput.min.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.2/js/plugins/purify.min.js"
    type="text/javascript"></script>
<!-- the main fileinput plugin file -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.2/js/fileinput.min.js"></script>
<!-- optionally if you need a theme like font awesome theme you can include it as mentioned below -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.2/themes/fas/theme.js"></script>
<!-- optionally if you need translation for your language then include  locale file as mentioned below -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.2/js/locales/ar.js"></script>


@yield('scripts')

@yield('AttendenceScripts')

@yield('votingGrahpScripts')

@include('layouts.PushScripts')
