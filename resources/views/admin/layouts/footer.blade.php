<!-- Vendor js -->
<script src="{{ asset('adminto/dist/assets/js/vendor.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('adminto/dist/assets/js/app.min.js') }}"></script>
<script src="{{asset('adminto/dist/assets/libs/select2/select2.min.js')}}"></script>
<script src="{{asset('adminto/dist/assets/libs/jquery-mask-plugin/jquery.mask.min.js')}}"></script>

<!-- Sweet Alerts js -->
<script src="{{asset('adminto/dist/assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  function rupiah(nominal) {
    return 'Rp '+parseInt(nominal).toLocaleString('id')
  }
</script>
@yield('js')