@extends('admin.templates.default')

@push('styles')
<style>
    #data_pencetak_gol {}

    #data_pencetak_gol .pemain {
        padding: 5px 10px;
        width: 375px;
        margin-bottom: 5px;
    border: none;
    border-bottom: 2px solid black;
    }

    #data_pencetak_gol .menit {
        padding: 5px 10px;
        width: 100px;
        margin-bottom: 5px;
        margin-left: 20px;
    border: none;
    border-bottom: 2px solid black;
    }
    #data_pencetak_gol .jenis-gol {
        padding: 5px 10px;
        width: 100px;
        margin-bottom: 5px;
        margin-left: 20px;
    border: none;
    border-bottom: 2px solid black;
    }

    #data_pencetak_gol .hapus {
        padding: 5px 10px;
        width: 100px;
        margin-bottom: 5px;
        margin-left: 20px;
    }

    #skor_rumah, #skor_tamu {
        padding: 33px;
    text-align: center;
    font-size: 39px;
    }

</style>
@endpush
@section('content')
<section class="content-header">
    <h1>
        Jadwal Pertandingan Akan Datang
    </h1>
    <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-users"></i> Pertandingan</a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Data Jadwal Pertandingan</h3>
                    <button id="tambah" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>
                        Tambah Jadwal</button>
                </div>

                <div class="box-body">
                    <table id="pertandingan-datatable" class="table table-bordered">

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



@include('admin.pertandingan.modal-detail')
@include('admin.pertandingan.form')
@include('admin.pertandingan.form-skor')

@endsection

@push('scripts')
<script src="{{ asset('js/pertandingan.js') }}"></script>
@endpush
