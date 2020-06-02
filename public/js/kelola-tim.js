var pemain_table;
var id_tim = $('#id_tim').val();

$(document).ready(function () {
    loadData();
    $('button#tambah').on('click', function () {
        clearModal();
        $('#modal_label').text('Form Tambah Pemain');
        $('#method_field').val("POST");
        $("#modal-form").modal('show');
    });

    $('i#btn-simpan').on('click', function () {
        insertUpdateProses();
    });
});

function loadData() {
    pemain_table = $('#pemain-datatable').DataTable({
        processing: true,
        ajax: {
            "url": "" + base_url_admin + '/getDataJson/tim-pemain/'+id_tim,
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
            }, {
                title: "Nomor Punggung ",
                data: "nomor_punggung",
                visible: true,
                sortable: true,
                class: "text-center"
            },
            {
                title: "Foto",
                data: "foto_pemain",
                visible: true,
                sortable: false,
                class: "text-center",
                render: function (data, type, full, meta) {
                    var result = '';
                    if (data == null) {
                        result += 'kosong';
                    } else {
                        result += '<a href="#" class="btn-detail-img"><img src="' + base_url + '/images/pemain/' + data + '" width="100px"height="100px"></a>';
                    }
                    return result;
                }
            },
            {
                title: "Nama",
                data: "nama",
                visible: true,
                sortable: true,
                class: ""
            }, {
                title: "Posisi",
                data: "nama_posisi",
                visible: true,
                sortable: true,
                class: ""
            }, {
                title: "Tanggal Lahir",
                data: "tanggal_lahir",
                visible: true,
                sortable: true,
                class: ""
            }, {
                title: "Tinggi Badan",
                data: "tinggi",
                visible: true,
                sortable: true,
                class: "text-center"
            }, {
                title: "Berat Badan",
                data: "berat",
                visible: true,
                sortable: true,
                class: "text-center"
            }, {
                title: "Aksi",
                data: "id",
                visible: true,
                sortable: false,
                class: "text-center",
                render: function (data, type, full, meta) {
                    var result = '';
                    result += '<td class="text-center">'; 
                    result += '<button class="btn btn-info  btn-sm"> <i class="fa fa-gear"></i> Atur</button>';
                    result += '</td>';
                    return result;
                }
            }
        ],
        "drawCallback": function (settings) {
            $('.btn-detail-img').on('click', function () {
                var data = pemain_table.row($(this).parents('tr')).data();
                $('#img-detail').attr('src', base_url + '/images/pemain/' + data.foto_pemain);
                $("#modal-detail-img").modal('show');
            })
            $('.btn-edit').on('click', function () {

                clearModal();
                var data = pemain_table.row($(this).parents('tr')).data();

                $('#id_pemain').val(data.id);
                $('#nama').val(data.nama);
                $('#tempat_lahir').val(data.tempat_lahir);
                $('#tanggal_lahir').val(data.tanggal_lahir);
                $('#tinggi_badan').val(data.tinggi);
                $('#tinggi_badan').val(data.tinggi);
                $('#berat_badan').val(data.berat);
                $("#posisi_pemain").val(data.id_posisi);

                if (data.foto_pemain) {

                    $('#preview-foto-pemain').attr('src', base_url + '/images/pemain/' + data.foto_pemain);
                }

                $('#modal_label').text('Form Ubah Data Pemain');
                $('#method_field').val("PUT");
                $("#modal-form").modal('show');
            });
            $('.btn-delete').on('click', function () {
                var data = pemain_table.row($(this).parents('tr')).data();

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
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
        var action_url = "" + base_url_admin + "/pemain";
        var action_type = "Tambah";
        if (method === "PUT") {
            action_url = "" + base_url_admin + "/pemain/" + $('#id_pemain').val();
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
                    pemain_table.ajax.reload(null, false);
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

// Example usage:

function delay(callback, ms) {
    var timer = 0;
    return function () {
        var context = this,
            args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 0);
    };
}
$('#cari_nama_pemain').keyup(delay(function (e) {
    var posisi_pemain = $("#cari_posisi_pemain").val();
    var kota_pemain = $("#cari_kota_pemain").val();
    var nama_pemain = this.value;

    $.ajax({
        type: 'GET',
        url: "" + base_url_admin + "/getDataJson/cari-pemain/",
        data: {
            "id_posisi": posisi_pemain,
            "kota": kota_pemain,
            "nama": nama_pemain
        },
        dataType: 'JSON',
        beforeSend: function () {},
        success: function (data) {
            if (data.status == "oke") {
                var pemain = data.data;
                console.log(pemain);

                var html = ""

                if (pemain.hasOwnProperty(0)) {
                    for (var key in pemain) {
                        if (pemain.hasOwnProperty(key)) {
                            console.log(key + " -> " + pemain[key].nama);
                            html += '<tr>'
                            html += '<td><img src="'+base_url+'/images/pemain/'+ pemain[key].foto_pemain+'" width="50px" height="50px"></td>'
                            html += '<td>' + pemain[key].nama_posisi + '</td>'
                            html += '<td>' + pemain[key].nama + '</td>'
                            html += '<td>' + pemain[key].tempat_lahir + '</td>'
                            html += '<td>' + pemain[key].tanggal_lahir + '</td>'
                            html += '<td>' + pemain[key].tinggi + ' Cm / ' + pemain[key].berat + ' Kg</td>'
                            html += '<td><i class="btn btn-info btn-sm btn-pilih" onclick="pilihPemain('+pemain[key].id+',\"'+pemain[key].nama+'\",\"'+pemain[key].nama_posisi+'\",\"'+pemain[key].foto_pemain+'\")">Pilih</i></td>'
                            html += '</tr>'
                        }
                    }
                } else {
                    html += '<tr> <td colspan="6" class="text-center">Data Pemain Tidak Ditemukan</td> </tr>'
                }

                $('#hasil_pencarian').empty().append(html)
            }
        },
        error: function (xmlhttprequest, textstatus, message) {
            sweetAlertDefault('<b>Koneksi Ke Server Gagal, Mohon Refresh Halaman</b>', 'error', 2000);
        }
    });

}, 500));

function pilihPemain(id, nama, posisi, foto){ 
    console.log(id);
}
 

function deleteProses(id) {
    $.ajax({
        type: 'GET',
        url: "" + base_url_admin + "/delete/pemain/" + id,
        dataType: 'JSON',
        beforeSend: function () {
            sweetAlertLoading('Memproses', null);
        },
        success: function (data) {
            if (data.status == 'delete_successful') {
                sweetAlertDefault('<b>Data Berhasil Terhapus</b>', 'success', 2000);
                pemain_table.ajax.reload(null, false);
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
    rules: {
        nama: {
            required: true,
            minlength: 5
        },
        tempat_lahir: {
            required: true,
            minlength: 3
        },
        tanggal_lahir: {
            required: true,
        },
        tinggi_badan: {
            required: true,
            number: true
        },
        berat_badan: {
            required: true,
            number: true
        },
        posisi_pemain: {
            required: true,
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


$("input[name='foto_pemain']").on("change", function () {
    if (this.files[0].size > 1000000) {
        alert("Maksimal Ukuran File 1MB");
        $(this).val('');
    } else {
        if (this.files[0].type == 'image/jpeg' || this.files[0].type == 'image/png') {
            previewImage();
        } else {
            alert("Foto Pemain Harus berupa Gambar Jpg/PNG");
            $(this).val('');
        }
    }
});


function previewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("foto_pemain").files[0]);
    oFReader.onload = function (oFREvent) {
        document.getElementById("preview-foto-pemain").src = oFREvent.target.result;
    }
}

function clearModal() {
    $('input').removeClass('is-valid is-invalid');
    $('select').removeClass('is-valid is-invalid');
    $('#form-data').closest('form').find('select').val('');
    $('#form-data').closest('form').find('input[type=text]').val('');
    $('#form-data').closest('form').find('input[type=file]').val('');
    $('#form-data').closest('form').find('input[type=date]').val('');
    $('#form-data').closest('form').find('input[type=number]').val('');
    $('#preview-foto-pemain').attr('src', '');
}
