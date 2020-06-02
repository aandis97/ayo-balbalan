var pertandingan_table;
var id_tim_rumah;
var id_tim_tamu;
var index = 0;
var skor_rumah = 0;
var skor_tamu = 0;
var data_jenis_gol;
var data_id_tim;

$(document).ready(function () {
    loadData();
    $('button#tambah').on('click', function () {
        clearModal();
        $('#modal_label').text('Form Tambah Jadwal Pertandingan');
        $('#method_field').val("POST");
        $("#modal-form").modal('show');
    });

    $('i#btn-simpan').on('click', function () {
        insertUpdateProses();
    });
    $('i#btn-simpan-skor').on('click', function () {
        Swal.fire({
            title: 'Skor Yang dimasukkan Sudah Bener Ya??',
            text: "Yakin!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33', 
            confirmButtonText: 'Oke, Simpan!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {        
                insertSkor();
            }
        })
    });

    var idx = 0;
    $('i#btn-tambah-skor').on('click', function () {
        var id = $('#data_tim').val().split(',');
        id_tim_rumah = $('#id-tim-rumah').val();
        id_tim_tamu = $('#id-tim-tamu').val();
        var menit = $('#data_menit').val();
        var jenis_gol = $('#jenis_gol').val();
        var text = $("#data_tim option:selected").text();

        var total_gol = parseInt($('#skor_rumah').val()) + parseInt($('#skor_tamu').val())
        // if(total_gol==0){

        //     alert("Tidak Ada gol. 0 - 0");
        // } else if(idx<total_gol) {
        if (id == "" || menit == "") {
            alert("Pilih Pemain dan masukan menit");
            return null;
        }
        var data_pencetak_gol = '<input type="hidden" class="data-id-tim" name="id_tim[]" value="' + id[0] + '">';
        data_pencetak_gol += '<input type="hidden" name="id_pemain[]" value="' + id[1] + '">';
        data_pencetak_gol += '<input type="hidden" name="menit[]" value="' + menit + '">';
        data_pencetak_gol += '<input type="hidden" name="jenis_gol[]" value="' + jenis_gol + '">';
        data_pencetak_gol += '<input type="text" class="pemain" readonly value="' + text + '">';
        data_pencetak_gol += '<input type="text" class="jenis-gol" readonly value="' + (jenis_gol == 1 ? 'Gol Poin' : 'Gol Bunuh Diri') + '">';
        data_pencetak_gol += '<input type="text" class="menit" readonly value="' + menit + '">';
        data_pencetak_gol += '<i class="btn btn-danger hapus" onclick="hapusDataPencetak(' + idx + ')"><i class="fa fa-trash"></i> Hapus</i>';
        console.log('id', id)
        console.log('text', text)
        $('#data_pencetak_gol').append("<div id='data_pencetak" + idx + "'>" + data_pencetak_gol + "</div>")
        idx++

        updateSkor()
        $('#data_menit').val("");
        $('#data_tim').val("");
        // } else {
        //     alert("Jumlah Gol Hanya "+total_gol);
        // }

    });
});

function hapusDataPencetak(id) {
    $('#data_pencetak' + id).remove()
    updateSkor()
}

function updateSkor() {
    id_tim_rumah = $('#id-tim-rumah').val();
    id_tim_tamu = $('#id-tim-tamu').val();
    index = 0;
    skor_rumah = 0;
    skor_tamu = 0;
    data_jenis_gol = $("input[name='jenis_gol[]']").map(function () {
        return $(this).val();
    }).get();
    data_id_tim = $('input[name^="id_tim"]').map(function () {
        if ($(this).val() == id_tim_rumah) {
            if (data_jenis_gol[index] == 1) {
                skor_rumah++;
            } else {
                skor_tamu++;
            }
        } else {
            if (data_jenis_gol[index] == 1) {
                skor_tamu++;
            } else {
                skor_rumah++;
            }
        }
        index++;
        return $(this).val();
    }).get();

    console.log('id_tim_rumah', id_tim_rumah);
    console.log('data_id_tim', data_id_tim);
    console.log('data_jenis_gol', data_jenis_gol);
    $('#skor_rumah').val(skor_rumah);
    $('#skor_tamu').val(skor_tamu);
}

function loadData() {
    pertandingan_table = $('#pertandingan-datatable').DataTable({
        processing: true,
        ajax: {
            "url": "" + base_url_admin + '/getDataJson/pertandingan',
            'type': 'GET',
            'dataType': 'JSON',
            'error': function (xhr, textStatus, ThrownException) {
                alert('Error loading data. Exception: ' + ThrownException + "\n" + textStatus);
            }
        },
        columns: [{
                title: "ID ",
                data: "id",
                visible: false,
                sortable: true,
                class: "text-center"
            },
            {
                title: "Jadwal Pertandingan",
                data: "jadwal_pertandingan",
                visible: true,
                sortable: true,
                class: "",
                render: function (data, type, full, meta) {
                    return data + " " + full.waktu_mulai;
                }
            },
            {
                title: "Logo Tim Tuan Rumah",
                data: "id_tim_rumah",
                visible: false,
                sortable: false,
                class: "text-center",

                render: function (data, type, full, meta) {
                    var result = '';
                    if (data == null) {
                        result += 'kosong';
                    } else {
                        result += '<a href="#" class="btn-detail-img"><img src="' + base_url + '/images/tim/logo/' + full.logo + '" width="100px" height="100px"></a>';
                    }
                    return result;
                }
            },
            {
                title: "Nama Tim Tuan Rumah",
                data: "nama_tim",
                visible: true,
                sortable: true,
                class: "text-center"

            },
            {
                title: "Kota Tuan Rumah",
                data: "kota",
                visible: true,
                sortable: true,
                class: "text-center"

            },
            {
                title: "Nama Tim Tamu",
                data: "nama_tim_tamu",
                visible: true,
                sortable: true,
                class: "text-center"

            },
            {
                title: "Kota Tamu",
                data: "kota_tamu",
                visible: true,
                sortable: true,
                class: "text-center"

            }, {
                title: "Hasil Pertandingan",
                data: "id",
                visible: true,
                sortable: false,
                class: "text-center",
                render: function (data, type, full, meta) {
                    
                    var tanggal = full.jadwal_pertandingan.split("-");
                    tanggal = tanggal[1]+'-'+tanggal[0]+'-'+tanggal[2];
                    tanggal = new Date(tanggal+' '+full.waktu_mulai);
                    
                    if(tanggal<current_datetime){
                        var result = '';
                        result += '<td class="text-center">';
                        result += '<button class="btn btn-success btn-sm btn-input-skor mr-5"> <i class="fa fa-gear"></i> Skor</button>';
                        result += '</td>';
                        return result;
                    } else {
                        return "-"
                    }
                }
            }, {
                title: "Aksi",
                data: "id",
                visible: true,
                sortable: false,
                class: "text-center",
                render: function (data, type, full, meta) {
                    var result = '';
                    result += '<td class="text-center">';
                    result += '<button class="btn btn-default btn-sm btn-detail mr-5"> <i class="fa fa-eye"></i> </button>';
                    result += '<button class="btn btn-info btn-sm btn-edit mr-5"> <i class="fa fa-edit"></i> </button>';
                    result += '<button class="btn btn-danger  btn-sm btn-delete"> <i class="fa fa-trash"></i> </button>';
                    result += '</td>';
                    return result;
                }
            }
        ],
        "drawCallback": function (settings) {

            $('.btn-input-skor').on('click', function () {
                var data = pertandingan_table.row($(this).parents('tr')).data();
                // var tim = '<option value="">'++'</option>';
                // $("#pilih_tim")
                $('#id-tim-rumah').val(data.id_tim_rumah);
                $('#id-tim-tamu').val(data.id_tim_tamu);
                $('#id_pertandingan_skor').val(data.id);

                $('#img-skor-logo').attr('src', base_url + '/images/tim/logo/' + data.logo);
                $('#skor-nama').html(data.nama_tim);
                $('#skor-kota').html(data.kota);
                $('#img-skor-logo-tamu').attr('src', base_url + '/images/tim/logo/' + data.logo_tamu);
                $('#skor-nama-tamu').html(data.nama_tim_tamu);
                $('#skor-kota-tamu').html(data.kota_tamu);
                $.ajax({
                    type: 'GET',
                    url: "" + base_url_admin + "/getDataJson/tim-pertandingan/",
                    data: {
                        "tim_rumah": data.id_tim_rumah,
                        "tim_tamu": data.id_tim_tamu
                    },
                    dataType: 'JSON',
                    beforeSend: function () {},
                    success: function (data) {
                        var pemain = data.data
                        var data_pemain = '<option value="">Pilih Pemain</option>';
                        for (var key in pemain) {
                            if (pemain.hasOwnProperty(key)) {
                                // console.log(key + " -> " + pemain[key]);
                                data_pemain += "<option value='" + pemain[key].id_tim + "," + pemain[key].id_pemain + "'>" + pemain[key].nama_tim + " - " + pemain[key].nomor_punggung + " | " + pemain[key].nama + "</li>";
                            }
                        }

                        $("#data_tim").html(data_pemain);
                        $("#modal-input-skor").modal('show');
                    },
                    error: function (xmlhttprequest, textstatus, message) {
                        sweetAlertDefault('<b>Koneksi Ke Server Gagal, Mohon Refresh Halaman</b>', 'error', 2000);
                    }
                });
            })

            $('.btn-detail').on('click', function () {
                var data = pertandingan_table.row($(this).parents('tr')).data();
                $('#img-detail-logo').attr('src', base_url + '/images/tim/logo/' + data.logo);
                $('#detail-nama').html(data.nama_tim);
                $('#detail-kota').html(data.kota);


                $('#img-detail-logo-tamu').attr('src', base_url + '/images/tim/logo/' + data.logo_tamu);
                $('#detail-nama-tamu').html(data.nama_tim_tamu);
                $('#detail-kota-tamu').html(data.kota_tamu);
                $("#modal-detail").modal('show');
            })
            $('.btn-edit').on('click', function () {

                clearModal();
                var data = pertandingan_table.row($(this).parents('tr')).data();

                $('#id_pertandingan').val(data.id);
                $('#tim_rumah').val(data.id_tim_rumah);
                $('#tim_tamu').val(data.id_tim_tamu);
                $('#jadwal_pertandingan').val(data.jadwal_pertandingan);
                $('#waktu_mulai').val(data.waktu_mulai);

                $('#modal_label').text('Form Ubah Jadwal Pertandingan');
                $('#method_field').val("PUT");
                $("#modal-form").modal('show');
            });
            $('.btn-delete').on('click', function () {
                var data = pertandingan_table.row($(this).parents('tr')).data();

                
                Swal.fire({
                    title: 'Yakin hapus "' + data.nama + '"?',
                    text: "Setelah terhapus data tidak bisa kembali!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        deleteProses(data.id);
                    }
                })
            });
        }
    });
}


function insertUpdateProses() {

    var form = $('#form-data');
    if (form.valid() == true) {

        var formData = new FormData($("#form-data")[0]);

        var method = $('#method_field').val();
        var action_url = "" + base_url_admin + "/pertandingan";
        var action_type = "Tambah";
        if (method === "PUT") {
            action_url = "" + base_url_admin + "/pertandingan/" + $('#id_pertandingan').val();
            action_type = "Ubah";

        }
        $.ajax({
            type: 'POST',
            url: action_url,
            dataType: 'JSON',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('i#btn-simpan').prop('disabled', true);
                sweetAlertLoading('Memproses', 5000);
            },
            success: function (data) {
                if (data.status == 'successful') {
                    sweetAlertDefault('<b>Berhasil ' + action_type + '</b>', 'success', 2000);
                    $('#modal-form').modal('toggle');
                    pertandingan_table.ajax.reload(null, false);
                } else if (data.status == 'failed') {
                    sweetAlertDefault('<b>Gagal ' + action_type + '</b>', 'error', 2000);
                } else {
                    sweetAlertDefault('<b>Gagal ' + action_type + ' (Kesalahan Sistem)</b>', 'error', 2000);
                }
                $('i#btn-simpan').prop('disabled', false);
            },
            error: function (xmlhttprequest, textstatus, message) {
                sweetAlertDefault('<b>Koneksi Ke Server Gagal, Mohon Refresh Halaman</b>', 'error', null);
            }

        });

    } else {
        sweetAlertLoading('Mohon Isi Form Dengan Lengkap, Cek Input Form Yang Berwarna Merah', 1000);
    }
}



function insertSkor() {
    var form = $('#form-data-skor');
    var formData = new FormData($("#form-data-skor")[0]);
    var action_url = "" + base_url_admin + "/pertandingan-skor";
    var action_type = "Tambah";
    $.ajax({
        type: 'POST',
        url: action_url,
        dataType: 'JSON',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $('i#btn-simpan').prop('disabled', true);
            sweetAlertLoading('Memproses', 5000);
        },
        success: function (data) {
            if (data.status == 'successful') {
                sweetAlertDefault('<b>Berhasil ' + action_type + '</b>', 'success', 2000);
                $('#modal-input-skor').modal('toggle');
                pertandingan_table.ajax.reload(null, false);
            } else if (data.status == 'failed') {
                sweetAlertDefault('<b>Gagal ' + action_type + '</b>', 'error', 2000);
            } else {
                sweetAlertDefault('<b>Gagal ' + action_type + ' (Kesalahan Sistem)</b>', 'error', 2000);
            }
            $('i#btn-simpan').prop('disabled', false);
        },
        error: function (xmlhttprequest, textstatus, message) {
            sweetAlertDefault('<b>Koneksi Ke Server Gagal, Mohon Refresh Halaman</b>', 'error', null);
        }

    });
}

function deleteProses(id) {
    $.ajax({
        type: 'GET',
        url: "" + base_url_admin + "/delete/pertandingan/" + id,
        dataType: 'JSON',
        beforeSend: function () {
            sweetAlertLoading('Memproses', null);
        },
        success: function (data) {
            if (data.status == 'delete_successful') {
                sweetAlertDefault('<b>Data Berhasil Terhapus</b>', 'success', 2000);
                pertandingan_table.ajax.reload(null, false);
            } else if (data.status == 'delete_failed') {
                sweetAlertDefault('<b>Gagal Hapus</b>', 'error', 2000);
            }
        },
        error: function (xmlhttprequest, textstatus, message) {
            sweetAlertDefault('<b>Koneksi Ke Server Gagal, Mohon Refresh Halaman</b>', 'error', 2000);
        }
    });

}

var validator = $('#form-data').validate({
    ignore: [],
    rules: {
        jadwal_pertandingan: {
            required: true
        },
        waktu_mulai: {
            required: true
        },
        tim_rumah: {
            required: true
        },
        tim_tamu: {
            required: true
        }
    },
    highlight: function (element, errorClass, validClass, error) {
        $(element.form).find("[id=" + element.id + "]").addClass('is-invalid');
        $(element.form).find("[id=" + element.id + "]").removeClass('is-valid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element.form).find("[id=" + element.id + "]").removeClass('is-invalid');
        $(element.form).find("[id=" + element.id + "]").addClass('is-valid');
    }
});

function clearModal() {
    $('input').removeClass('is-valid is-invalid');
    $('select').removeClass('is-valid is-invalid');
    $('#form-data').closest('form').find('textarea').val('');
    $('#form-data').closest('form').find('select').val('');
    $('#form-data').closest('form').find('input[type=text]').val('');
    $('#form-data').closest('form').find('input[type=file]').val('');
    $('#form-data').closest('form').find('input[type=date]').val('');
    $('#form-data').closest('form').find('input[type=number]').val('');
    $('#preview-foto').attr('src', '');
}
