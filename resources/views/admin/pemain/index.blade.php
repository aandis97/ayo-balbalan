@extends('admin.templates.default')

@section('content')
@include('admin.templates.partials._alerts')
<section class="content-header">
    <h1>
        Pemain
    </h1>
    <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-users"></i> Pemain</a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Data Pemain</h3>
                    <button id="tambah" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>
                        Tambah Pemain</button>
                </div>

                <div class="box-body">
                    <table id="pemain-datatable" class="table table-bordered">

                    </table>
                </div>
            </div>
        </div>
    </div>

</section>


<div class="modal fade" id="modal-detail-img">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Detail Foto Pemain</h4>
        </div>
        <div class="modal-body">
          <img id="img-detail" src="" alt="" style="width: 100%">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
        </div>
      </div> 
    </div> 
  </div>

  @include('admin.pemain.form')

@endsection

@push('scripts')
<script src="{{ asset('js/pemain.js') }}" defer></script>
@endpush
