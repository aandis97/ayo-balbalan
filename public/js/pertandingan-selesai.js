var pertandingan_table;
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
});

function loadData() {
    pertandingan_table = $('#pertandingan-datatable').DataTable({
        processing: true,
        ajax: {
            "url": "" + base_url_admin + '/getDataJson/pertandingan',
            'type': 'GET',
            'data' : {
                'selesai' : 1
            },
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
                    return data+" "+full.waktu_mulai;
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

            }, 
            {
                title: "Skor Akhir",
                data: "id",
                visible: true,
                sortable: true,                
                class: "text-center",
                render: function (data, type, full, meta) { 
                    return full.gol_rumah+" - "+full.gol_tamu;
                }

            },  {
                title: "Aksi",
                data: "id",
                visible: true,
                sortable: false,
                class: "text-center",
                render: function (data, type, full, meta) {
                    var result = '';
                    result += '<td class="text-center">';
                    result += '<button class="btn btn-default btn-sm btn-detail mr-5"> <i class="fa fa-eye"></i> </button>'; 
                    result += '</td>';
                    return result;
                }
            }
        ],
        "drawCallback": function (settings) { 
            $('.btn-detail').on('click', function () {
                var data = pertandingan_table.row($(this).parents('tr')).data();
                var id_tim_rumah = data.id_tim_rumah;
                $('#img-detail-logo').attr('src', base_url + '/images/tim/logo/' + data.logo);
                $('#detail-nama').html(data.nama_tim); 
                $('#detail-kota').html(data.kota); 
                $('#detail-gol-rumah').html(data.gol_rumah); 

                
                $('#img-detail-logo-tamu').attr('src', base_url + '/images/tim/logo/' + data.logo_tamu);
                $('#detail-nama-tamu').html(data.nama_tim_tamu); 
                $('#detail-kota-tamu').html(data.kota_tamu);
                $('#detail-gol-tamu').html(data.gol_tamu); 

                $.ajax({
                    type: 'GET',
                    url: "" + base_url_admin + "/pertandingan-selesai/"+data.id,
                    dataType: 'JSON',
                    beforeSend: function () {},
                    success: function (data) {
                        var pemain = data.data
                        var data_pemain = '';
                        $("#data_pencetak_gol").empty()
                        for (var key in pemain) {
                            if (pemain.hasOwnProperty(key)) { 
                                data_pemain = "<tr>";
                                if(id_tim_rumah==pemain[key].id_tim) { 
                                        data_pemain += "<td  class='text-right'>"+(pemain[key].jenis_gol==2 ? '(og)':'')+"" + pemain[key].nama +" | "+ pemain[key].menit + "'</td>";
                                        data_pemain += "<td class='text-center'><i class='fa fa-soccer-ball-o "+(pemain[key].jenis_gol==1 ? 'text-green' : 'text-red')+"'></i></td>";
                                        data_pemain += "<td></td>";
                                } else { 
                                        data_pemain += "<td></td>";
                                        data_pemain += "<td class='text-center'><i class='fa fa-soccer-ball-o "+(pemain[key].jenis_gol==1 ? 'text-green' : 'text-red')+"'></i></td>";
                                        data_pemain += "<td>"+ pemain[key].menit + "' | " + pemain[key].nama +" "+(pemain[key].jenis_gol==2 ? '(og)':'')+"</td>";
                                }
                                data_pemain += "</tr>";
                                $("#data_pencetak_gol").append(data_pemain);
                            }
                        } 
                        $("#modal-detail").modal('show');
                    },
                    error: function (xmlhttprequest, textstatus, message) {
                        sweetAlertDefault('<b>Koneksi Ke Server Gagal, Mohon Refresh Halaman</b>', 'error', 2000);
                    }
                }); 

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
