<div class="modal fade" id="modal-form">
    <div class="modal-dialog  modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_label">Form</h4>
            </div>

            <form class="form-horizontal form-label-left" id="form-data" method="post" enctype="multipart/form-data">

                @csrf
                <input type="hidden" id="method_field" name="_method" value="POST" />
                <input type="hidden" class="form-control" placeholder="Nama Kategori Paper" id="id_pemain"
                    value="{{ old('id_pemain') }}" name="id_pemain">
                <div class="modal-body">
                    <div class="form-modal">
                        <div id="error-validation"></div>


                        <div class="form-group  mb-0">
                            <label>Nama Lengkap<i class="text-danger">*</i></label>
                            <input type="text" class="form-control" placeholder="Nama Lengkap Pemain" id="nama"
                                value="{{ old('nama') }}" name="nama" required>
                            <label for="nama" generated="true" class="error"></label>
                            <label id="validationError"></label>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group  mb-0 mmr-5">
                                    <label>Tempat Lahir<i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" placeholder="Tempat Lahir" id="tempat_lahir"
                                        value="{{ old('tempat_lahir') }}" name="tempat_lahir" required>
                                    <label for="tempat_lahir" generated="true" class="error"></label>
                                    <label id="validationError"></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group  mb-0 ">
                                    <label>Tanggal Lahir<i class="text-danger">*</i></label>
                                    <input type="date" class="form-control" placeholder="Tanggal Lahir"
                                        id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" name="tanggal_lahir"
                                        required>
                                    <label for="tanggal_lahir" generated="true" class="error"></label>
                                    <label id="validationError"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group  mb-0 mmr-5">
                                    <label>Posisi Pemain<i class="text-danger">*</i></label>
                                    <select name="posisi_pemain" id="posisi_pemain" class="form-control">
                                        <option value="">Pilih Posisi</option>
                                        @foreach($posisiPemain as $posisi)
                                        <option value="{{ $posisi->id }}">{{ $posisi->nama_posisi }}</option>
                                        @endforeach
                                    </select>
                                    <label for="posisi_pemain" generated="true" class="error"></label>
                                    <label id="validationError"></label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group  mb-0 mmr-5">
                                    <label>Tinggi Badan<i class="text-danger">*</i></label>

                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="000.0" id="tinggi_badan"
                                            value="{{ old('tinggi_badan') }}" name="tinggi_badan" required>
                                        <span class="input-group-addon">Cm</span>
                                    </div>
                                    <label for="tinggi_badan" generated="true" class="error"></label>
                                    <label id="validationError"></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group  mb-0">
                                    <label>Berat Badan<i class="text-danger">*</i></label>
                                    <div class="input-group">

                                        <input type="text" class="form-control" placeholder="000.0" id="berat_badan"
                                            value="{{ old('berat_badan') }}" name="berat_badan" required>
                                        <span class="input-group-addon">Kg</span>
                                    </div>
                                    <label for="berat_badan" generated="true" class="error"></label>
                                    <label id="validationError"></label>
                                </div>
                            </div>
                        </div>

                        <hr class="mt-5 mb-10">

                        <div class="form-group  mb-0">
                            <div style=" width: 260px; background: white; margin-left: 10px; padding-left:10px; position: relative;">
                                <label>Masukan Tim Bermain</label> : <i class="btn btn-info btn-sm" id="btn-tim-bermain" style="width: 95px;"><i class="fa fa-soccer-ball-o"></i> Tim Bermain</i>
                            </div>
                        </div>
                        <div class="row" id="input-tim-bermain" style="border: 1px solid #a9a9a9; padding: 10px; margin-top:-16px; padding-top: 20px; display:none">
                            <div class="col-md-8">
                                <div class="form-group  mb-0 mmr-5">
                                    <label>Tim Bermain<i class="text-danger">*</i></label>
                                    <select name="tim_bermain" id="tim_bermain" class="form-control">
                                        <option value="">- Pilih Tim Bermain</option>
                                        @foreach($dataTim as $tim)
                                        <option value="{{ $tim->id }}">{{ $tim->nama_tim." - ".$tim->kota }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group  mb-0">
                                    <label>Nomor Punggung<i class="text-danger">*</i></label>
                                    <input type="number" class="form-control" placeholder="00" id="nomor_punggung"
                                        value="{{ old('nomor_punggung') }}" name="nomor_punggung" maxlenght="2">
                                    <label for="nomor_punggung" generated="true" class="error"></label>
                                    <label id="validationError"></label>
                                </div>
                            </div>
                        </div>
                        <hr class="mt-10 mb-10">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <div class="image-preview"
                                    style="width: 100px;overflow:hidden;height: 120px; border:1px solid #b3b3b3;">
                                    <img src="" style="width:100%" alt="" id="preview-foto-pemain">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group  mb-0 mmr-5">
                                    <label>Foto Pemain</label>
                                    <input type="file" class="form-control" id="foto_pemain" accept="image/*"
                                        value="{{ old('foto_pemain') }}" name="foto_pemain">
                                    <label for="foto_pemain" generated="true" class="error"></label>
                                    <label id="validationError"></label>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Batal</button>
                    <i id="btn-simpan" class="btn btn-success"> <i class="fa fa-save"></i> Simpan</i>
                </div>
            </form>
        </div>
    </div>
</div>
