    <script src="{{ asset('lte/js/jquery.min.js') }}"></script>
    <script src="{{ asset('lte/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lte/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('lte/js/demo.js') }}"></script>
    <script src="{{ asset('lte/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('lte/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('lte/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lte/js/bootstrap-datepicker.js')}} "></script>
    <script src="{{ asset('lte/js/locales/bootstrap-datepicker.es.js') }}"></script>
    <script src="{{ asset('lte/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('lte/js/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('lte/js/moment.min.js') }}"></script>
    <script src="{{ asset('lte/js/locales.min.js')}}"></script>
    <script src="{{ asset('lte/js/daterangepicker.js') }}"></script>
    <script src="{{ asset('lte/js/fontawesome-iconpicker.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="{{ asset('lte/js/factory.js') }}"></script>
    <script src="{{ asset('lte/js/admin-functions.js') }}"></script>
    {{-- SWEETALERT --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @include('sweet::alert')
    {{-- PRELOADER --}}
    <script>
        $(window).on('load', function(){
            setTimeout(() => {
                $('.loader_bg').fadeOut(); 
            }, 1000);
        })
    </script>
</body>
</html>