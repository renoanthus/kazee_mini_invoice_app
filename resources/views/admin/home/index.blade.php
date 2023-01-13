@extends('admin.layouts.main')

@section('title')
<title>Dashboard </title>
@endsection
@section('css')
<link href="{{asset('adminto/dist/assets/libs/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

@endsection
@section('caption')
<h4 class="page-title-main">Dashboard</h4>
@endsection

@section('content')
<!-- Start Content-->
<div class="container-fluid">
  <div class="row">
    <div class="col-xl-6 col-md-6 px-2">
      <div class="card-box widget-user">
        <div class="text-center">
          <h2 class="font-weight-normal text-success pengguna_bayar" data-plugin="counterup">
          </h2>
          <h5>Total Products</h5>
        </div>
      </div>
    </div>
    <div class="col-xl-6 col-md-6 px-2">
      <div class="card-box widget-user">
        <div class="text-center">
          <h2 class="font-weight-normal text-info pengguna_register" data-plugin="counterup">
          </h2>
          <h5>Total Invoices</h5>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('js')
@endsection