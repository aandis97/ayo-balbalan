
<div class="modal fade" id="modal-input-skor">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Input Skor Hasil Pertandingan</h4>
            </div>
            <form  id="form-data-skor" method="post" >

                @csrf
                <input type="hidden" id="method_field" name="_method" value="POST" />
                <input type="hidden" class="form-control" id="id_pertandingan_skor" name="id_pertandingan_skor">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 mmr-5">

                            <div class="row">
                                <div class="col-md-12">
                                    
                                    <input type="text" class="hidden" id="id-tim-rumah">
                                    <input type="text" class="hidden" id="id-tim-tamu">
                                    <table class="table  mb-0">
                                        <tr>
                                          <td>
                                          <center>
                                                <img id="img-skor-logo" src="" alt="" style="width: 50%">
                                          </center>
                                          </td>
                                            <td class="text-center" width="10%" rowspan="3">
                                                <h2 class="text-center">Vs</h2>
                                            </td>
                                          <td>
                                          <center>
                                                <img id="img-skor-logo-tamu" src="" alt="" style="width: 50%">
                                          </center>
                                          </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" width="45%"> <b><span id="skor-nama"></span></b>
                                            </td> 
                                            <td class="text-center" width="45%"> <b><span
                                                        id="skor-nama-tamu"></span></b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><span id="skor-kota"></span> </td>
                                            <td class="text-center"><span id="skor-kota-tamu"></span> </td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                            <hr class="mt-5 mb-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="text-center mt-0">Skor Akhir</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group  mb-0 mmr-5">
                                        <input type="text" class="form-control" value="0" id="skor_rumah"
                                            value="{{ old('skor_rumah') }}" name="skor_rumah" readonly>
                                        <label for="skor_rumah" generated="true" class="error"></label>
                                        <label id="validationError"></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group  mb-0 ">
                                        <input type="text" class="form-control" value="0" id="skor_tamu"
                                            value="{{ old('skor_tamu') }}" name="skor_tamu" readonly>
                                        <label for="skor_tamu" generated="true" class="error"></label>
                                        <label id="validationError"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8" style="border-left:1px solid black; min-height: 315px;">
                            <h4>Data Pencetak Gol</h4>
                            <hr class="mt-0 mb-5">

                            <div class="row mb-5">
                                <!-- <div class="col-md-4">

                                <div class="form-group  mb-5 mmr-10">
                                    <label>Pilih Tim</label>
                                    <div class="input-group">
                                            
                                        <input type="radio" name="pilih_tim" id="pilih_tim" value="a"> Tim Rumah
                                        <input type="radio" name="pilih_tim" id="pilih_tim" value="b" class="ml-10"> Tim Tamu
                                    </div>
                                </div>
                            </div> -->
                                <div class="col-md-6">
                                    <div class="form-group  mb-5 mmr-10">
                                        <label>Nama Pemain</label>
                                        <select name="data_tim" id="data_tim" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-0 ">
                                        <label>Jenis Skor</label>
                                        <select name="jenis_gol" id="jenis_gol" class="form-control">
                                            <option value="1">Gol Poin</option>
                                            <option value="2">Gol Bunuh Diri</option>
                                        </select> 

                                        <label for="data_menit" generated="true" class="error"></label>
                                        <label id="validationError"></label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-0 ">
                                        <label>Menit</label>
                                        <input type="text" class="form-control" placeholder="menit" id="data_menit"
                                            value="{{ old('data_menit') }}" name="data_menit" required>

                                        <label for="data_menit" generated="true" class="error"></label>
                                        <label id="validationError"></label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-0 ">

                                        <label style="color:white">____</label>
                                        <i class="btn btn-primary" id="btn-tambah-skor"><i class="fa fa-plus"></i>
                                            Tambah</i>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">

                                    <div id="data_pencetak_gol">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Batal</button>
                    <i id="btn-simpan-skor" class="btn btn-success"> <i class="fa fa-save"></i> Simpan</i>
                </div>
            </form>
        </div>
    </div>
</div>