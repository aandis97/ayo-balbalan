<div class="modal fade" id="modal-form">
    <div class="modal-dialog  modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_label">Form</h4>
            </div>

            <form class="form-horizontal form-label-left" id="form-data" method="POST" >

                @csrf
                <input type="hidden" id="method_field" name="_method" value="POST" />
                <input type="hidden" class="form-control" id="id_pertandingan" value="{{ old('id_pertandingan') }}" name="id_pertandingan">
                <div class="modal-body">
                    <div class="form-modal">
                        <div id="error-validation"></div>
                        <div class="form-group  mb-0">
                            <label>Tim Tuan Rumah<i class="text-danger">*</i></label>

                            <select name="tim_rumah" id="tim_rumah" class="form-control">
                                <option value="">- Pilih Tim Tuan Rumah</option>
                                @foreach($dataTim as $tim)
                                    <option value="{{ $tim->id }}">{{ $tim->nama_tim." - ".$tim->kota }}</option>
                                @endforeach
                            </select>
                            <label for="tim_rumah" generated="true" class="error"></label>
                            <label id="validationError"></label>
                        </div>
                        <div class="form-group  mb-0">
                            <label>Tim Tamu<i class="text-danger">*</i></label>
                            <select name="tim_tamu" id="tim_tamu" class="form-control ">
                                <option value="">- Pilih Tim Tamu</option>
                                @foreach($dataTim as $tim)
                                    <option value="{{ $tim->id }}">{{ $tim->nama_tim." - ".$tim->kota }}</option>
                                @endforeach
                            </select>
                            <label for="tim_tamu" generated="true" class="error"></label>
                            <label id="validationError"></label>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group  mb-0 mmr-5">
                                    <label>Tanggal Pertandingan<i class="text-danger">*</i></label>
                                    <input type="text" class="form-control thedate" placeholder="00/00/0000" id="jadwal_pertandingan"
                                        value="{{ old('jadwal_pertandingan') }}" name="jadwal_pertandingan" required>
                                    <label for="jadwal_pertandingan" generated="true" class="error"></label>
                                    <label id="validationError"></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group  mb-0 ">
                                    <label>Waktu Mulai<i class="text-danger">*</i></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control timepicker" name="waktu_mulai"
                                            id="waktu_mulai" required>
                                        <div class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                    </div>
                                    <label for="waktu_mulai" generated="true" class="error"></label>
                                    <label id="validationError"></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group  mb-0">
                            <label>Keterangan / Informasi Informasi</label>
                            <textarea name="keterangan_pertandingan" id="keterangan_pertandingan" class="form-control"
                                placeholder="Informasi tambahan tentang pertandingan" cols="30" rows="3"></textarea>
                            <label for="keterangan_pertandingan" generated="true" class="error"></label>
                            <label id="validationError"></label>
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
