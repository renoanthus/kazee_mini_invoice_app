<!-- Vendor js -->
<script src="{{ asset('adminto/dist/assets/js/vendor.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('adminto/dist/assets/js/app.min.js') }}"></script>
<script src="{{asset('adminto/dist/assets/libs/select2/select2.min.js')}}"></script>

<!-- Sweet Alerts js -->
<script src="{{asset('adminto/dist/assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])