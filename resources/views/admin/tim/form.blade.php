
<div class="modal fade" id="modal-form">
    <div class="modal-dialog  modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_label">Form</h4>
            </div>

            <form class="form-horizontal form-label-left" id="form-data" method="post"  enctype="multipart/form-data">

                @csrf
                <input type="hidden" id="method_field" name="_method" value="POST" />
                <input type="hidden" class="form-control" id="id_tim"
                    value="{{ old('id_tim') }}" name="id_tim">
                <div class="modal-body">
                    <div class="form-modal">
                        <div id="error-validation"></div>
                        <div class="form-group  mb-0">
                            <label>Nama Tim<i class="text-danger">*</i></label>
                            <input type="text" class="form-control" placeholder="Nama Tim" id="nama_tim" name="nama_tim" required>
                            <label for="nama_tim" generated="true" class="error"></label>
                            <label id="validationError"></label>
                        </div>
                        <div class="form-group  mb-0">
                            <label>Alamat Markas Tim<i class="text-danger">*</i></label>
                            <input type="text" class="form-control" placeholder="Nama Markas Tim" id="alamat_tim" name="alamat_tim" required>
                            <label for="alamat_tim" generated="true" class="error"></label>
                            <label id="validationError"></label>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group  mb-0 mmr-5">
                                    <label>Kota<i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" placeholder="Kota" id="kota_tim"
                                        value="{{ old('kota_tim') }}" name="kota_tim" required>
                                    <label for="kota_tim" generated="true" class="error"></label>
                                    <label id="validationError"></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group  mb-0 ">
                                    <label>Tahun Berdiri<i class="text-danger">*</i></label>
                                    <input type="number" class="form-control" placeholder="0000"
                                        id="tahun_berdiri" value="{{ old('tahun_berdiri') }}" name="tahun_berdiri"
                                        required>
                                    <label for="tahun_berdiri" generated="true" class="error"></label>
                                    <label id="validationError"></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group  mb-0">
                            <label>Keterangan / Informasi</label>
                            <textarea name="keterangan_tim" id="keterangan_tim" class="form-control" placeholder="Informasi tambahan tentang tim dan kontak" cols="30" rows="3"></textarea>
                            <label for="keterangan_tim" generated="true" class="error"></label>
                            <label id="validationError"></label>
                        </div> 
                        <hr class="mt-0 mb-10">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <div class="image-preview" style="width: 100px;overflow:hidden;height: 100px; border:1px solid #b3b3b3;">
                                  <img src="" style="width:100%" alt="" id="preview-foto">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group  mb-0 mmr-5">
                                    <label>Logo Tim</label>
                                    <input type="file" class="form-control" id="logo_tim" accept="image/*"
                                        value="{{ old('logo_tim') }}" name="logo_tim">
                                    <label for="logo_tim" generated="true" class="error"></label>
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