@extends('admin.templates.default')

@section('content')
@include('admin.templates.partials._alerts')
<section class="content-header">
    <h1>
        Tim Sepak Bola
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('tim.index') }}"><i class="fa fa-users"></i> Tim</a></li>
        <li class="active"> Kelola Tim</li>
    </ol>
</section>


<section class="content" style="padding-bottom:0px">
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Informasi TIM</h3>
                    <a href="{{  route('tim.index') }}" class="btn btn-default pull-right"><i class="fa fa-arrow-left"></i>
                        Kembali</a>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal">
        <div class="box-body">
            <input type="hidden" name="id_tim" id="id_tim" value="{{$infoTim->id}}">
            <div class="row">
                <div class="col-md-2">
                    <center>
                        <img id="img-detail-logo" src="{{ asset('images/tim/logo/'.$infoTim->logo) }}" alt="" style="width: 80%">
                    </center>
                </div>
                <div class="col-md-5">
                    <table class="table">
                        <tr>
                            <td width="30%">Nama Tim </td>
                            <td>: <b>{{ $infoTim->nama_tim }}</b> </td>
                        </tr>
                        <tr>
                            <td>Alamat Markar Tim </td>
                            <td>: <b>{{ $infoTim->alamat_tim }}</b> </td>
                        </tr>
                        <tr>
                            <td>Kota </td>
                            <td>: <b>{{ $infoTim->kota }}</b> </td>
                        </tr>
                        <tr>
                            <td>Tahun Berdiri </td>
                            <td>: <b>{{ $infoTim->tahun_berdiri }}</b> </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-5" style="overflow:hidden">
                  <b>Keterangan / Informasi: </b>
                  <p>{{ $infoTim->excerpt }} </p>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <!-- /.box-footer -->
    </form>
</div>
</section>
<section class="content" style="padding-top:0px">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Kelola Pemain</h3>
                    <button id="tambah" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>
                        Tambah Pemain Baru</button>
                </div>

                <div class="box-body">
                    <table id="pemain-datatable" class="table table-bordered">

                    </table>
                </div>
            </div>
        </div>
    </div>

</section>



@include('admin.tim.kelola-tim.form')

@endsection

@push('scripts')
<script src="{{ asset('js/kelola-tim.js') }}"></script>
@endpush
