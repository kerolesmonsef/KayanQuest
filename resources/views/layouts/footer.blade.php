<footer class="main-footer text-center">

    <strong>&copy; {{ Carbon\Carbon::now()->format('Y') }} {{ env('APP_NAME') }}</strong>
    جميع الحقوق محفوظة
    <!-- jQuery -->
    <script src="{{ asset('adminLTE_design/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI-->
    <script src="{{ asset('adminLTE_design/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- popper -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminLTE_design/docs/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminLTE_design/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('adminLTE_design/dist/js/demo.js') }}"></script>
    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        @if ($errors->count())
        Swal.fire(
            'error',
            '{{ $errors->first() }}',
            'error'
        );
        @endif

        @if (session()->has('s_alert_success'))
        Swal.fire(
            'Success',
            '{{ session()->get('s_alert_success') }}',
            'success'
        );
        @endif
    </script>
    @yield('script')
</footer>

