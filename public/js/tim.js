var tim_table;
$(document).ready(function () {
    loadData();
    $('button#tambah').on('click', function () {
        clearModal();
        $('#modal_label').text('Form Tambah Tim Sepak Bola');
        $('#method_field').val("POST");
        $("#modal-form").modal('show');
    });

    $('i#btn-simpan').on('click', function () {
        insertUpdateProses();
    });
});

function loadData() {
    tim_table = $('#tim-datatable').DataTable({
        processing: true,
        ajax: {
            "url": "" + base_url_admin + '/getDataJson/tim',
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
                title: "Logo Team",
                data: "logo",
                visible: true,
                sortable: false,
                class: "text-center",
                render: function (data, type, full, meta) {
                    var result = '';
                    if (data == null) {
                        result += 'kosong';
                    } else {
                        result += '<a href="#" class="btn-detail-img"><img src="' + base_url + '/images/tim/logo/' + data + '" width="100px" height="100px"></a>';
                    }
                    return result;
                }
            },
            {
                title: "Nama",
                data: "nama_tim",
                visible: true,
                sortable: true,
                class: ""
            }, {
                title: "Alamat Markas",
                data: "alamat_tim",
                visible: true,
                sortable: true,
                class: ""
            }, {
                title: "Kota",
                data: "kota",
                visible: true,
                sortable: true,
                class: ""
            }, {
                title: "Tahun Berdiri",
                data: "tahun_berdiri",
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
                    result += '<a href="'+base_url_admin+'/tim/'+data+'/edit" class="btn btn-success btn-sm mr-5"> <i class="fa fa-gear"></i> Kelola Tim </a>';
                    result += '<button class="btn btn-default btn-sm btn-detail mr-5"> <i class="fa fa-eye"></i> </button>';
                    result += '<button class="btn btn-info btn-sm btn-edit mr-5"> <i class="fa fa-edit"></i> </button>';
                    result += '<button class="btn btn-danger  btn-sm btn-delete"> <i class="fa fa-trash"></i> </button>';
                    result += '</td>';
                    return result;
                }
            }
        ],
        "drawCallback": function (settings) {
            $('.btn-detail-img').on('click', function () {
                var data = tim_table.row($(this).parents('tr')).data();
                $('#img-detail').attr('src', base_url + '/images/tim/logo/' + data.logo);
                $("#modal-detail-img").modal('show');
            });
            
            $('.btn-detail').on('click', function () {
                var data = tim_table.row($(this).parents('tr')).data();
                $('#img-detail-logo').attr('src', base_url + '/images/tim/logo/' + data.logo);
                
                $('#detail-nama').html(data.nama_tim);
                $('#detail-alamat').html(data.alamat_tim);
                $('#detail-kota').html(data.kota);
                $('#detail-tahun').html(data.tahun_berdiri);
                $('#detail-keterangan').html(data.keterangan_tim);
                $("#modal-detail").modal('show');
            })
            $('.btn-edit').on('click', function () {
                 
                clearModal();
                var data = tim_table.row($(this).parents('tr')).data();

                $('#id_tim').val(data.id);
                $('#nama_tim').val(data.nama_tim);
                $('#alamat_tim').val(data.alamat_tim);
                $('#keterangan_tim').val(data.keterangan_tim);
                $('#tahun_berdiri').val(data.tahun_berdiri);
                $('#kota_tim').val(data.kota);

                if (data.logo) {
                    $('#preview-foto').attr('src', base_url + '/images/tim/logo/' + data.logo);
                }

                $('#modal_label').text('Form Ubah Data Pemain');
                $('#method_field').val("PUT");
                $("#modal-form").modal('show');
            });
            $('.btn-delete').on('click', function () {
                var data = tim_table.row($(this).parents('tr')).data();


                Swal.fire({
                    title: 'Yakin hapus "' + data.nama_tim + '"?',
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
        var action_url = "" + base_url_admin + "/tim";
        var action_type = "Tambah";
        if (method === "PUT") {
            action_url = "" + base_url_admin + "/tim/" + $('#id_tim').val();
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
                    tim_table.ajax.reload(null, false);
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


function deleteProses(id) {
    $.ajax({
        type: 'GET',
        url: "" + base_url_admin + "/delete/tim/" + id,
        dataType: 'JSON',
        beforeSend: function () {
            sweetAlertLoading('Memproses', null);
        },
        success: function (data) {
            if (data.status == 'delete_successful') {
                sweetAlertDefault('<b>Data Berhasil Terhapus</b>', 'success', 2000);
                tim_table.ajax.reload(null, false);
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
        nama_tim: {
            required: true,
            minlength: 5
        },
        alamat_tim: {
            required: true,
            minlength: 10
        },
        tahun_berdiri: {
            required: true,
            exactlength: 4,
            number :true
        },
        kota_tim: {
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


$("input[name='logo_tim']").on("change", function () {
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
    oFReader.readAsDataURL(document.getElementById("logo_tim").files[0]);
    oFReader.onload = function (oFREvent) {
        document.getElementById("preview-foto").src = oFREvent.target.result;
    }
}

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
