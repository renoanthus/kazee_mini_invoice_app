@extends('admin.layouts.main')

@section('title')
<title>Invoice </title>
@endsection
@section('css')
<link href="{{asset('adminto/dist/assets/libs/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

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
        <form id="formFilter">
          <div class="row shadow-sm mb-2">
            <div class="form-group col-md-6">
              <label class="col-form-label">Kode Invoice :</label>
              <input type="text" name="kode_filter" id="kode_filter" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label for="" class="col-form-label">Filter Tanggal :</label>
              <div id="reportrange" class="form-control">
                  <i class="fa fa-calendar"></i>
                  <span></span>
              </div>
            </div>
          </div>
        </form>
        <div class="row head_table">
          <div class="col-md-2">
            <a href="{{ route('admin.invoice.create') }}"
              class="btn btn-block btn-primary btn-sm waves-effect waves-light mb-2">Tambah</a>
          </div>
        </div>
        <div class="table-responsive">
          <table id="datatable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Aksi</th>
                <th>No Invoice</th>
                <th>Tanggal Invoice</th>
                <th>Jumlah Produk</th>
                <th>Total Harga</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modalProduct" tabindex="-1" role="dialog" aria-labelledby="modal1Title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form id="formProduct" data-parsley-validate="" enctype="multipart/form-data">
          @csrf
          <div class="modal-header">
            <h4 class="modal-title" id="modal1Title">Tambah Produk</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <input type="hidden" id="id" name="id">
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="name" class="mb-0">Nama Produk *</label>
                    <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                      placeholder="Nama Produk" required>
                  </div>
                  <div class="col-md-6">
                    <label for="code" class="mb-0">Kode Produk *</label>
                    <input type="text" class="form-control" id="kode_produk" name="kode_produk"
                      placeholder="Kode Produk" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="price" class="mb-0">Harga (Rp) *</label>
                    <input type="text" class="form-control money" id="harga_produk" name="harga_produk"
                      placeholder="Harga" required>
                  </div>
                  <div class="col-md-6">
                    <label for="price" class="mb-0">Sisa Stok *</label>
                    <input type="text" class="form-control money" id="sisa_stok" name="sisa_stok"
                      placeholder="Sisa Stok" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label class="mb-0">Foto Produk</label>
                    <input type="file" id="foto_produk" name="foto_produk" accept="image/*" class="form-control"
                      required>
                  </div>
                  <div class="col-md-6">
                    <label for="keterangan_produk" class="mb-0">Keterangan Produk *</label>
                    <input type="text" class="form-control" id="keterangan_produk" name="keterangan_produk" placeholder="Keterangan Produk" required>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary" id="simpan">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
@section('js')
<script src="{{asset('adminto/dist/assets/libs/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminto/dist/assets/libs/datatables/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('adminto/dist/assets/libs/datatables/dataTables.responsive.min.js')}}">
</script>
<script src="{{asset('adminto/dist/assets/libs/datatables/responsive.bootstrap4.min.js')}}">
</script>

<script src="{{asset('adminto/dist/assets/libs/moment/moment.js')}}"></script>
<script src="{{asset('adminto/dist')}}/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="{{asset('adminto/dist')}}/assets/libs/bootstrap-daterangepicker/daterangepicker.js"></script>
<script>
  $(document).ready(function () {
    $('.select').select2()

    

    $("#reportrange span").html(moment().format("MMM D, YYYY") + " - " + moment().format("MMM D, YYYY")), $("#reportrange").daterangepicker({
        format: "MMM/DD/YYYY",
        startDate: moment(),
        endDate: moment(),
        minDate: "01/01/2021",
        maxDate: "12/31/2023",
        dateLimit: {
            days: 365
        },
        showDropdowns: !0,
        showWeekNumbers: !0,
        timePicker: !1,
        timePickerIncrement: 1,
        timePicker12Hour: !0,
        ranges: {
            Today: [moment(), moment()],
            Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
            "Last 7 Days": [moment().subtract(6, "days"), moment()],
            "Last 30 Days": [moment().subtract(29, "days"), moment()],
            "This Month": [moment().startOf("month"), moment().endOf("month")],
            "Last Month": [moment().subtract(1, "month").startOf("month"), moment().endOf("month")],
            "Last 2 Month": [moment().subtract(2, "month").startOf("month"), moment().endOf("month")],
            "Last 3 Month": [moment().subtract(3, "month").startOf("month"), moment().endOf("month")],
            "Day Of Last Year": [moment().subtract(365, "days"), moment()],
        },
        opens: "center",
        drops: "down",
        buttonClasses: ["btn", "btn-sm"],
        applyClass: "btn-success",
        cancelClass: "btn-secondary",
        separator: " to ",
        locale: {
            applyLabel: "Submit",
            cancelLabel: "Cancel",
            fromLabel: "From",
            toLabel: "To",
            customRangeLabel: "Custom",
            daysOfWeek: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
            monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            firstDay: 1
        }
    }, function (e, t, a) {
        $("#reportrange span").html(e.format("MMM D, YYYY") + " - " + t.format("MMM D, YYYY"))
    })

    //data table
    $(function() {
      clearSession();
      window.oTable1 = $('#datatable').DataTable({
        "ordering": false,
        "processing": true,
        "serverSide": true,
        "pageLength": 25,
        "searching": false,
        "autoWidth": false,
        "ajax": {
          url: "{{ route('admin.invoice.data')}}",
          data: function (d) {
            d.kode_filter = sessionStorage.kode_filter;
            d.tanggal_filter = sessionStorage.tanggal_filter;
          }
        },
        "columns": [
          {
            data: 'id_invoice',
            searchable: false,
            width:'10px',
            fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
              $(nTd).html(`${oData.DT_RowIndex}`);
            }
          },
          {
            data: 'aksi',
            orderable: false,
            searchable: false,
            width:'140px',
          },
          {
            data: 'id_invoice',
            defaultContent: '-',
          },
          {
            data: 'tanggal_invoice',
            defaultContent: '-',
          },
          {
            data: 'products_count',
            defaultContent: '-',
          },
          {
            data: 'total_harga',
            defaultContent: '-',
          },
        ]
      });
      function clearSession(){
        sessionStorage.removeItem('kode_filter');
        sessionStorage.removeItem('tanggal_filter');
      }
      $('#kode_filter').on('focusout', function (e) {
        sessionStorage.setItem('kode_filter', this.value);
        oTable1.draw();
        e.preventDefault();
      });
      $('#reportrange span').on('DOMSubtreeModified', function (e) {
        sessionStorage.setItem('tanggal_filter', $("#reportrange span").html());
        oTable1.draw();
        e.preventDefault();
      });
    });

    $('body').on('click', '.btn-ubah', function(e){
      e.preventDefault();
      $("#modalProduct").modal("show")
      $('#foto_produk').nextAll().remove();
      $('#foto_produk').val('');
      $("#modal1Title").val("Ubah Produk")
      var id = $(this).data('id')
      $.ajax({
        type: "get",
        url: "{{ route('admin.invoice.index') }}/show/"+id,
        success: function (data) {
          $('#id').val(data.id);
          $('#nama_produk').val(data.nama_produk);
          $('#kode_produk').val(data.kode_produk);
          $('#harga_produk').val(data.harga_produk);
          $('#foto_produk').attr('required',false);
          $('#sisa_stok').val(data.sisa_stok).trigger('change');
          $('#keterangan_produk').val(data.keterangan_produk);
          var gambar = '{{ asset('') }}'+data.foto_produk
          var f = new File([], gambar)
          var fileReader = new FileReader();
          fileReader.onload = (function(e) {
            var file = e.target;
            $("<span class=\"pip\">" +
              "<img style='max-width:100px' data-image_id="+data.id+" class=\"imageThumbEdit\" src=\"" + gambar + "\" title=\"" + data.nama_produk+ "\"/>" +
              "<br/><span class=\"remove\">Remove image</span>" +
              "</span>").insertAfter("#foto_produk");
            $(".remove").click(function(){
              $(this).parent(".pip").remove();
            });
            
          });
          fileReader.readAsDataURL(f);
        }
      });
    });

    $('body').on('click', '.btn-hapus', function(e){
      e.preventDefault();
      let id = $(this).data('id')
      swal.fire({
        title: "Hapus Produk",
        text: "Produk Akan Dihapus Secara Permanen, Apakah Anda Yakin ?",
        type: "question",
        showCancelButton: !0,
        confirmButtonText: "Yakin !",
        cancelButtonText: "Batal !",
        reverseButtons: !0
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "{{ route('admin.invoice.delete')}}",
            type: "delete",
            dataType: "JSON",
            data : {
              token : "{{ csrf_token() }}",
              id : id,
            }
          })
          .done(function(response){
            if (response.status == true) {
              Swal.fire("Sukses", response.message, "success");
              setTimeout(function(){
                oTable1.ajax.reload();
              }, 1000);
            }else{
              Swal.fire("Gagal", response.message, "error");
            }
          });
        }
      })
    });

    $('body').on('submit', '#formProduct', function(e){
      e.preventDefault();
      $.ajax({
          url: "{{ route('admin.invoice.store') }}",
          type: "POST",
          data: new FormData(this),
          dataType: 'JSON',
          contentType: false,
          cache: true,
          processData: false,
      })
      .done(function(response) {
        if (response.status) {
          Swal.fire("Sukses", response.message, "success");
          $('#modalProduct').on('hidden.bs.modal', function(e){
            $('#formProduct')[0].reset();
          });
          $('#modalProduct').modal('hide');
          setTimeout(function(){
            oTable1.ajax.reload()
          }, 500)
        } else {
          Swal.fire("Gagal", response.message, "warning");
        }
      })
      .fail(function(response) {
        Swal.fire("Gagal", response.message, "warning");
      });
      return false;
    });
  });
</script>
@endsection
