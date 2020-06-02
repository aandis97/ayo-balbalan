@extends('admin.templates.default')

@section('content')
@include('admin.templates.partials._alerts')
<section class="content-header">
    <h1>
        Pertandingan Selesai
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
                    <h3 class="box-title">Data Jadwal Pertandingan Selesai</h3>
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

<div class="modal fade" id="modal-detail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Detail Hasil Skor Pertandingan</h4>
            </div>
            <div class="modal-body" style="padding-top:0px !important">
                <div class="row">
                    <div class="col-md-12">
                    <!-- <h4 class="mb-10"> <i class="fa fa-calendar"></i> <span id="jadwal_pertandingan">00-00-0000 | 00:00 Wib</span></h4> -->
                        <table class="table  mb-0">
                            <tr>
                                <td  style="vertical-align:middle">
                                <center>
                                    <img id="img-detail-logo" src="" alt="" style="width: 80%">
                                </center>
                                </td>
                                <td class="text-center" width="10%" rowspan="3"  style="vertical-align:middle; border-left:1px solid #cacaca;  border-right:1px solid #cacaca; ">
                                    <h2 class="text-center">Vs</h2>
                                </td>
                                <td  valign="center"  style="vertical-align:middle">
                                <center>
                                    <img id="img-detail-logo-tamu" src="" alt="" style="width: 80%">
                                </center>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" width="45%"> <b><span id="detail-nama"></span></b>
                                </td>
                                <td class="text-center" width="45%"> <b><span id="detail-nama-tamu"></span></b>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"><span id="detail-kota"></span> </td>
                                <td class="text-center"><span id="detail-kota-tamu"></span> </td>
                            </tr>
                            <tr>
                                <td class="text-center"><span id="detail-gol-rumah" style="font-size:30px">-</span> </td>
                                <td class="text-center"><h4>Gol</h4></td>
                                <td class="text-center"><span id="detail-gol-tamu" style="font-size:30px">-</span> </td>
                            </tr>
                            <tbody id="data_pencetak_gol"></tbody>
                             
                        </table>
                        <hr class="mt-5 mb-5">
                    </div> 
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script src="{{ asset('js/pertandingan-selesai.js') }}"></script>
@endpush
