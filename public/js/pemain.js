var pemain_table;
var tim_bermain = 0;

$(document).ready(function () {
    loadData();
    $('button#tambah').on('click', function () {
        clearModal();
        $('#input-tim-bermain').hide();
        $('#btn-tim-bermain').html('<i class="fa fa-soccer-ball-o"></i> Tim Bermain');
        $('#btn-tim-bermain').removeClass('btn-default').addClass('btn-info');
        $("#tim_bermain").prop('required',false);
        $("#nomor_punggung").prop('required',false);
        tim_bermain=0;
        $('#modal_label').text('Form Tambah Pemain');
        $('#method_field').val("POST");
        $("#modal-form").modal('show');
    });

    $('i#btn-simpan').on('click', function () {
        insertUpdateProses();
    });

    $('i#btn-tim-bermain').on('click', function () {
        if(tim_bermain==0) {
            $('#input-tim-bermain').show();
            $('#btn-tim-bermain').html('<i class="fa fa-close"></i> Batal');
            $('#btn-tim-bermain').removeClass('btn-info').addClass('btn-default');
            $("#tim_bermain").prop('required',true);
            $("#nomor_punggung").prop('required',true);
            tim_bermain=1;
        } else {
            $('#input-tim-bermain').hide();
            $('#btn-tim-bermain').html('<i class="fa fa-soccer-ball-o"></i> Tim Bermain');
            $('#btn-tim-bermain').removeClass('btn-default').addClass('btn-info');
            $("#tim_bermain").prop('required',false);
            $("#nomor_punggung").prop('required',false);
            tim_bermain=0;
        }

    });

    

});

function loadData() {
    pemain_table = $('#pemain-datatable').DataTable({
        processing: true,
        ajax: {
            "url": "" + base_url_admin + '/getDataJson/pemain',
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
                title: "id_posisi ",
                data: "id_posisi",
                visible: false,
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
                        result += '<a href="#" class="btn-detail-img"><img src="' + base_url + '/images/pemain/' + data + '" width="100px" height="100px"></a>';
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
            },{
                title: "Tim Bermain",
                data: "nama_tim",
                visible: true,
                sortable: true,
                class: "text-center",
                render: function (data, type, full, meta) {
                    if(data){
                        return data;
                    } 
                    return "<label class='label label-default'>Belum Bermain</label>"
                }
            },{
                title: "Nomor Punggung",
                data: "nomor_punggung",
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
                title: "Status Bermain",
                data: "bermain",
                visible: false,
                sortable: false
            }, {
                title: "Aksi",
                data: "id",
                visible: true,
                sortable: false,
                class: "text-center",
                render: function (data, type, full, meta) {
                    var result = '';
                    result += '<td class="text-center">';
                    result += '<button class="btn btn-info btn-sm btn-edit mr-5"> <i class="fa fa-edit"></i> </button>';
                    result += '<button class="btn btn-danger  btn-sm btn-delete"> <i class="fa fa-trash"></i> </button>';
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

                
        if(data.bermain==1) {
            $('#input-tim-bermain').show();
            $('#btn-tim-bermain').html('<i class="fa fa-close"></i> Batal');
            $('#btn-tim-bermain').removeClass('btn-info').addClass('btn-default');
            $("#tim_bermain").prop('required',true);
            $("#nomor_punggung").prop('required',true);
            
            $("#tim_bermain").val(data.id_tim);
            
            $("#nomor_punggung").val(data.nomor_punggung);
            tim_bermain=1;
        } else {
            $('#input-tim-bermain').hide();
            $('#btn-tim-bermain').html('<i class="fa fa-soccer-ball-o"></i> Tim Bermain');
            $('#btn-tim-bermain').removeClass('btn-default').addClass('btn-info');
            $("#tim_bermain").prop('required',false);
            $("#nomor_punggung").prop('required',false);
            tim_bermain=0;
        }

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
                    if(data.hasOwnProperty('error_nomor_punggung')){
                        alert(data.error_nomor_punggung);
                        $("label[for='nomor_punggung']").append(data.error_nomor_punggung);
                        $("input[name='nomor_punggung']").addClass("is-invalid"); 
                    }
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
            number:true
        },
        berat_badan: {
            required: true,
            number:true
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
