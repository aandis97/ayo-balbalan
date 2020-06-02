@extends('admin.templates.default')

@section('content')
@include('admin.templates.partials._alerts')
<section class="content-header">
    <h1>
        Tim Sepak Bola
    </h1>
    <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-users"></i> Tim</a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Data Tim</h3>
                    <button id="tambah" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>
                        Tambah Tim</button>
                </div>

                <div class="box-body">
                    <table id="tim-datatable" class="table table-bordered">

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
                <h4 class="modal-title">Detail Logo Tim</h4>
            </div>
            <div class="modal-body">
                <img id="img-detail" src="" alt="" style="width: 100%">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-detail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Detail Tim</h4>
            </div>
            <div class="modal-body">
            <div class="row">
              <div class="col-md-4">
                  <center>
                      <img id="img-detail-logo" src="" alt="" style="width: 80%">
                  </center>
              </div>
              <div class="col-md-8">
                <table class="table">
                  <tr>
                    <td>Nama Tim </td>
                    <td>: <b><span id="detail-nama"></span></b> </td>
                  </tr>
                  <tr>
                    <td>Alamat Markar Tim </td>
                    <td>: <b><span id="detail-alamat"></span></b> </td>
                  </tr>
                  <tr>
                    <td>Kota </td>
                    <td>: <b><span id="detail-kota"></span></b> </td>
                  </tr>
                  <tr>
                    <td>Tahun Berdiri </td>
                    <td>: <b><span id="detail-tahun"></span></b> </td>
                  </tr>
                </table>
              </div>
              <hr>
              <div style="padding: 0px 23px;">
                
                <b>Keterangan / Informasi : </b>
                <p id="detail-keterangan" ></p>
              </div>
            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@include('admin.tim.form')

@endsection

@push('scripts')
<script src="{{ asset('js/tim.js') }}"></script>
@endpush
