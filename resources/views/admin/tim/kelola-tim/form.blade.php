
<div class="modal fade" id="modal-form">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_label">Form</h4>
            </div>

            <form class="form-horizontal form-label-left" id="form-data" method="post" >

                @csrf
                <input type="hidden" id="method_field" name="_method" value="POST" />
                <input type="hidden" class="form-control" id="id_tim"
                    value="{{ old('id_tim') }}" name="id_tim">
                <div class="modal-body">
                    <div class="form-modal">
                        <div id="error-validation"></div>
                        <div class="row" style="border: 1px solid black;
    padding: 15px;
    border-radius: 10px;">
                        <h3 class="mt-0">Cari Pemain :</h3>
                        
                            <div class="col-md-3">
                                <div class="form-group  mb-0  mmr-5">
                                    <label>Kota</label>
                                    <input type="text" class="form-control" placeholder="Kota Pemain"
                                        id="cari_kota_pemain"   name="cari_kota_pemain"
                                        >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group  mb-0 mmr-5">
                                    <label>Posisi Pemain</label>
                                    <select name="cari_posisi_pemain" id="cari_posisi_pemain" class="form-control">
                                        <option value="">Semua Posisi</option>
                                        @foreach($posisiPemain as $posisi)
                                        <option value="{{ $posisi->id }}">{{ $posisi->nama_posisi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group  mb-0 ">
                                    <label>Cari Nama Pemain</label>
                                    <input type="text" class="form-control" placeholder="Nama Pemain"
                                        id="cari_nama_pemain"   name="cari_nama_pemain"
                                        >
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <hr>
                                <h4 class="mt-0 mb-0">Hasil Pencarian. Data Pemain yang belum mendapatkan tim :</h4>
                                <table class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th>Foto</th>
                                            <th>Posisi Pemain</th>
                                            <th>Nama</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Tinggi & Berat Badan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="hasil_pencarian">
                                    </tbody>
                                </table>
                            </div>

                        </div>
                                    
                        <!-- <div class="form-group  mb-0">
                            <label>Nomor Punggung<i class="text-danger">*</i></label>
                            <input type="number" class="form-control" placeholder="00" id="nomor_punggung" name="nomor_punggung" required>
                            <label for="nomor_punggung" generated="true" class="error"></label>
                            <label id="validationError"></label>
                        </div> -->

                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Batal</button>
                    <i id="btn-simpan" class="btn btn-success"> <i class="fa fa-save"></i> Simpan</i>
                </div> -->
            </form>
        </div> 
    </div> 
</div>