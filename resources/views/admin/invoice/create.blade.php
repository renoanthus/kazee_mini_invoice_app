@extends('admin.layouts.main')

@section('title')
<title>Invoice </title>
@endsection
@section('css')
<link href="{{asset('adminto/dist/')}}/assets/libs/bootstrap-datepicker/bootstrap-datepicker.css" rel="stylesheet">
<link href="{{asset('adminto/dist/')}}/assets/libs/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

@endsection
@section('caption')
<h4 class="page-title-main">Invoice</h4>
@endsection

@section('content')
<!-- Start Content-->
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card-box">
        <div class="row head_table">
          <h4 class="mt-0 header-title">Form Invoice</h4>
        </div>
        <form method="post" id="formAdd" enctype="multipart/form-data" action="{{ route('admin.invoice.store') }}">
          @csrf
          <div class="form-group row mt-3">
              <label class="col-form-label">Tanggal</label>
              <div class="input-group">
                <input type="text" class="form-control datepicker" name="tanggal" value="{{ $hari_ini }}" placeholder="dd/mm/yyyy" id="datepicker-autoclose">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="ti-calendar"></i></span>
                </div>
              </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-2 ml-auto">
              <button type="button" class="btn btn-block btn-primary tombol_tambah"><i class="mdi mdi-plus"></i>Tambah
                Produk</button>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Nama Produk</th>
                  <th>Gambar Produk</th>
                  <th>Harga Produk</th>
                  <th>Jumlah Produk</th>
                  <th>Total Harga Produk</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody class="tbody_data">
                @if ($produk_invoice)
                  <input type="hidden" name="id_invoice" value="{{ $invoice->id_invoice }}">
                    @foreach ($produk_invoice as $key => $item)
                      <tr class="tambah_data{{ $key }}">
                        <td>
                          <select class="form-control select2 produk_id reset" data-key="{{ $key }}" name="produk_id[]" required="">
                            <option value="">Pilih Produk</option>
                            @foreach ($produk as $element)
                            <option value="{{$element->id}}" {{ $element->id == $item->id ? 'selected' : '' }}>{{$element->nama_produk}}</option>
                            @endforeach
                          </select>
                        </td>
                        <td class="foto_produk{{ $key }} reset">
                          <a data-fancybox="grup" data-src="{{ asset('images/img_placeholder.jpeg') }}">
                            <img style="max-width:100px;max-height:67px" src="{{ asset($item->foto_produk ?? 'images/img_placeholder.jpeg') }}" />
                          </a>
                        </td>
                        <td>
                          <input type="text" readonly parsley-trigger="change" required=""
                            placeholder="Harga Produk" class="form-control money reset harga_produk{{ $key }}">
                        </td>
                        <td>
                          <input type="text" name="jumlah_produk[]" parsley-trigger="change"  required=""
                            placeholder="Jumlah Produk" value="{{ $item->pivot?->jumlah ?? 1 }}" min="1" class="form-control money reset jumlah_produk{{ $key }}">
                        </td>
                        <td>
                          <input type="text" readonly parsley-trigger="change" required=""
                            placeholder="Total Harga Produk" class="form-control money reset total_harga{{ $key }}">
                        </td>
                        <td>
                          @if ($key == 0)
                            <button type="button" disabled="" class="btn btn-block btn-danger btn-sm hapus tombol_hapus"><i
                              class="mdi mdi-trash-can-outline"></i></button>
                          @else
                            <button type="button" class="btn btn-block btn-danger btn-sm btn_hapus" required="" data-key="{{ $key }}"><i class="mdi mdi-trash-can-outline"></i></button>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                @else
                  <tr class="tambah_data0">
                    <td>
                      <select class="form-control select2 produk_id reset" data-key="0" name="produk_id[]" required="">
                        <option value="">Pilih Produk</option>
                        @foreach ($produk as $element)
                        <option value="{{$element->id}}">{{$element->nama_produk}}</option>
                        @endforeach
                      </select>
                    </td>
                    <td class="foto_produk0 reset">
                      <a data-fancybox="grup" data-src="{{ asset('images/img_placeholder.jpeg') }}">
                        <img style="max-width:100px;max-height:67px" src="{{ asset('images/img_placeholder.jpeg') }}" />
                      </a>
                    </td>
                    <td>
                      <input type="text" readonly parsley-trigger="change" required=""
                        placeholder="Harga Produk" class="form-control money reset harga_produk0">
                    </td>
                    <td>
                      <input type="text" name="jumlah_produk[]" parsley-trigger="change" required=""
                        placeholder="Jumlah Produk" value="1" min="1" class="form-control money reset jumlah_produk0">
                    </td>
                    <td>
                      <input type="text" readonly parsley-trigger="change" required=""
                        placeholder="Total Harga Produk" class="form-control money reset total_harga0">
                    </td>
                    <td>
                      <button type="button" disabled="" class="btn btn-block btn-danger btn-sm hapus tombol_hapus"><i
                          class="mdi mdi-trash-can-outline"></i></button>
                    </td>
                  </tr>
                @endif
              </tbody>
            </table>
            <a href="{{ route('admin.invoice.index') }}" class="btn btn-secondary waves-effect"
              data-dismiss="modal">Batal</a>
            <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
@section('js')
<script src="{{ asset('adminto/dist/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

<script src="{{asset('adminto/dist')}}/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="{{asset('adminto/dist')}}/assets/libs/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- Validation js (Parsleyjs) -->
<script src="{{asset('adminto/dist/')}}/assets/libs/parsleyjs/parsley.min.js"></script>
<script src="{{asset('adminto/dist/')}}/assets/js/pages/form-validation.init.js"></script>
<script>
  $(document).ready(function () {
    $('.select2').select2()
    $('.money').mask('000.000.000.000.000', {
      reverse: true,
      min:1,
      allowZero:false,
      negative:false,
    });
    $(".datepicker").datepicker({
      format : 'dd/mm/yyyy',
    });
    var key_form = {{ $produk_invoice ? count($produk_invoice) : 1 }};
    function total_produk(selector,jumlah,harga) {
      jumlah = jumlah.replace('.','').replace('.','').replace('.','')
      $(`.total_harga${selector}`).val(rupiah(parseInt(jumlah) * parseInt(harga)))
    }
    $('body').on('change', '.produk_id', function(e){
      e.preventDefault();
      var id = $(this).val()
      var key = $(this).data('key')
      if (id) {
        $.ajax({
          type: "get",
          url: "{{ route('admin.product.index') }}/show/"+id,
          success: function (data) {
            $(`.foto_produk${key}`).empty()
            $(`.foto_produk${key}`).append(`
              <a data-fancybox="grup${key}" data-src="{{ asset('${data.foto_produk}') }}">
                <img style="max-width:100px;max-height:67px" src="{{ asset('${data.foto_produk}') }}" />
              </a>
            `);
            $(`.harga_produk${key}`).val(rupiah(data.harga_produk))
            
            var jumlah = $(`.jumlah_produk${key}`).val()
            $(`.jumlah_produk${key}`).keyup(function (e) { 
              e.preventDefault();
              jumlah = $(`.jumlah_produk${key}`).val()
              // $(`.total_harga${key}`).val(rupiah(jumlah * data.harga_produk))
              total_produk(key,jumlah,data.harga_produk)
            });
            total_produk(key,jumlah,data.harga_produk)
          }
        });
      } else {
        $(`.foto_produk${key}`).empty()
        $(`.foto_produk${key}`).append(`
          <a data-fancybox="grup${key}" data-src="{{ asset('images/img_placeholder.jpeg') }}">
            <img style="max-width:100px;max-height:67px" src="{{ asset('images/img_placeholder.jpeg') }}" />
          </a>
        `);
        $(`.harga_produk${key}`).val('')
      }
    });
    $('.produk_id').trigger('change');

    $('body').on('click', '.btn_hapus', function() {
      var key = $(this).data('key')
      $('.tambah_data'+key).remove()
    })

    $('body').on('click', '.tombol_tambah', function() {
      var form = $('.tambah_data');
      $('.tbody_data').append(`
        <tr class="tambah_data${key_form}">
          <td>
            <select class="form-control select2 produk_id reset" data-key="${key_form}" name="produk_id[]" required="">
              <option value="">Pilih Produk</option>
              @foreach ($produk as $element)
              <option value="{{$element->id}}">{{$element->nama_produk}}</option>
              @endforeach
            </select>
          </td>
          <td class="foto_produk${key_form} reset">
            <a data-fancybox="grup" data-src="{{ asset('images/img_placeholder.jpeg') }}">
              <img style="max-width:100px;max-height:67px" src="{{ asset('images/img_placeholder.jpeg') }}" />
            </a>
          </td>
          <td>
            <input type="text" name="harga_produk[]" readonly parsley-trigger="change" required=""
              placeholder="Harga Produk" class="form-control money reset harga_produk${key_form}">
          </td>
          <td>
            <input type="text" name="jumlah_produk[]" parsley-trigger="change" required=""
              placeholder="Jumlah Produk" value="1" min="1" class="form-control money reset jumlah_produk${key_form}">
          </td>
          <td>
            <input type="text" name="total_harga[]" readonly parsley-trigger="change" required=""
              placeholder="Total Harga Produk" class="form-control money reset total_harga${key_form}">
          </td>
          <td>
              <button type="button" class="btn btn-block btn-danger btn-sm btn_hapus" required="" data-key="${key_form}"><i class="mdi mdi-trash-can-outline"></i></button>
          </td>
        </tr>
      `)            
      append_produk('produk_id'+key_form)
      $(".select2").select2();
      $('.money').mask('000.000.000.000.000', {reverse: true});
      key_form++;
    });
  
    function append_produk(selector) {
      var produk = <?php echo $produk ?>;
      $.each(produk, function(index, val) {
        $('.'+selector).append(`<option value="${val.id}">${val.nama_produk}</option>`);
      });
    }
    
  });

</script>
@endsection