let table = $('#table');
let fileName = table.attr("data-fileName");

$(document).ready(function() {
    $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn';

    $('#table').DataTable({
        dom: "<'row'<'col-md-4'l><'col-md-4'B><'col-md-4'f>>" +
            "<'row'<'col-md-12'tr>>" +
            "<'row'<'col-md-5'i><'col-md-7'p>>",
        lengthMenu: [
            [5, 10, 20, 50, -1],
            ['5', '10', '20', '50', 'Semua']
        ],
        buttons: [{
                extend: 'excelHtml5',
                title: fileName + ' PPDB LKP TC',
                className: 'btn-primary'
            },
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'A4',
                title: fileName + ' PPDB LKP TC',
                // exportOptions: {
                //     columns: [0, 1, 2, 4, 6, 7, 8, 9]
                // },
                className: 'btn-primary'
            },
            {
                extend: 'print',
                title: fileName + ' PPDB LKP TC',
                className: 'btn-primary'
            }
        ]
    });

    $('.select-option').select2({
        dropdownParent: $('.modal-form')
    });

    Inputmask().mask(document.querySelectorAll("input"));
});

$('#cetak-kartu').on('click', function() {
    html2canvas(document.getElementById("card")).then(function(canvas) {
        let anchorTag = document.createElement("a");
        anchorTag.download = "Kartu Login Ujian.jpg";
        anchorTag.href = canvas.toDataURL();
        anchorTag.target = '_blank';
        anchorTag.click();
    });
});

$('#datetime').on('mouseenter', function() {
    $(this).setAttribute('placeholder', 'dd/mm/yyyy HH.MM')
});

// $('#modalJadwal').on('show.bs.modal', function(event) {
//     var button = event.relatedTarget;
//     var userId = button.getAttribute('data-bs-id');
//     var modalInputId = modalJadwal.querySelector('#userId');
//     modalInputId.value = userId;
// });

$(document).on('select2:open', () => {
    document.querySelector('.select2-search__field').focus();
});

$('#register-form').validate({
    rules: {
        name: {
            required: true,
            minlength: 3
        },
        email: {
            required: true,
            email: true
        },
        password: {
            required: true,
            minlength: 6
        }
    },
    messages: {
        name: {
            required: "Nama wajib diisi",
            minlength: "Masukkan nama minimal 3 huruf"
        },
        email: {
            required: "Email wajib diisi",
            email: "Masukkan email yang benar"
        },
        password: {
            required: "Password wajib diisi",
            minlength: "Masukkan password minimal 6 digit"
        }
    },
    errorPlacement: function(label, element) {
        label.addClass('tx-12 text-danger');
        label.insertBefore(element);
    },
    highlight: function(element, errorClass) {
        $(element).parent().addClass('validation-error');
        $(element).addClass('border-danger');
    },
    unhighlight: function(element, errorClass) {
        $(element).parent().removeClass('validation-error');
        $(element).removeClass('border-danger');
    }
});

$('#login-form').validate({
    rules: {
        email: {
            required: true,
            email: true
        },
        password: {
            required: true
        }
    },
    messages: {
        email: {
            required: "Email wajib diisi",
            email: "Masukkan email yang benar"
        },
        password: {
            required: "Password wajib diisi"
        }
    },
    errorPlacement: function(label, element) {
        label.addClass('tx-12 text-danger');
        label.insertBefore(element);
    },
    highlight: function(element, errorClass) {
        $(element).parent().addClass('validation-error');
        $(element).addClass('border-danger');
    },
    unhighlight: function(element, errorClass) {
        $(element).parent().removeClass('validation-error');
        $(element).removeClass('border-danger');
    }
});

$('#biodata-form').validate({
    rules: {
        nama_lengkap: {
            required: true,
            minlength: 3
        },
        no_telp: {
            required: true,
            minlength: 10
        }
    },
    messages: {
        nama_lengkap: {
            required: "Nama wajib diisi",
            minlength: "Masukkan nama minimal 3 huruf"
        },
        no_telp: {
            required: "No Telepon/WA wajib diisi",
            minlength: "Masukkan no telepon/WA minimal 10 digit"
        }
    },
    errorPlacement: function(label, element) {
        label.addClass('mt-1 tx-13 text-danger');
        label.insertAfter(element);
    },
    highlight: function(element, errorClass) {
        $(element).parent().addClass('validation-error');
        $(element).addClass('border-danger');
    },
    unhighlight: function(element, errorClass) {
        $(element).parent().removeClass('validation-error');
        $(element).removeClass('border-danger');
    }
});

$('#jurusan-form').validate({
    rules: {
        jurusan1: {
            required: true
        },
        jurusan2: {
            required: true
        }
    },
    messages: {
        jurusan1: {
            required: "Jurusan 1 wajib dipilih"
        },
        jurusan2: {
            required: "Jurusan 2 wajib dipilih"
        }
    },
    errorPlacement: function(label, element) {
        label.addClass('mt-1 tx-13 text-danger');
        label.insertAfter(element);
    },
    highlight: function(element, errorClass) {
        $(element).parent().addClass('validation-error');
        $(element).addClass('border-danger');
    },
    unhighlight: function(element, errorClass) {
        $(element).parent().removeClass('validation-error');
        $(element).removeClass('border-danger');
    }
});

$('#datakeluarga-form').validate({
    rules: {
        nama_ayah: {
            required: true
        },
        pekerjaan_ayah: {
            required: true
        },
        nama_ibu: {
            required: true
        },
        pekerjaan_ibu: {
            required: true
        }
    },
    messages: {
        nama_ayah: {
            required: "Nama ayah wajib diisi"
        },
        pekerjaan_ayah: {
            required: "Pekerjaan ayah wajib diisi"
        },
        nama_ibu: {
            required: "Nama ibu wajib diisi"
        },
        pekerjaan_ibu: {
            required: "Pekerjaan ibu wajib diisi"
        }
    },
    errorPlacement: function(label, element) {
        label.addClass('mt-1 tx-13 text-danger');
        label.insertAfter(element);
    },
    highlight: function(element, errorClass) {
        $(element).parent().addClass('validation-error');
        $(element).addClass('border-danger');
    },
    unhighlight: function(element, errorClass) {
        $(element).parent().removeClass('validation-error');
        $(element).removeClass('border-danger');
    }
});

$('#modal-form').validate({
    rules: {
        user: {
            required: true,
        },
        status: {
            required: true,
        },
        password: {
            required: true,
            minlength: 6
        },
        waktu: {
            required: true
        },
        ruangan: {
            required: true
        }
    },
    messages: {
        user: {
            required: "Peserta wajib dipilih",
        },
        status: {
            required: "Status lulus wajib dipilih",
        },
        password: {
            required: "Password wajib diisi",
            minlength: "Masukkan password minimal 6 digit"
        },
        waktu: {
            required: "Tanggal & waktu ujian wajib diisi"
        },
        ruangan: {
            required: "Ruangan ujian wajib dipilih"
        }
    },
    errorPlacement: function(label, element) {
        label.addClass('mt-1 tx-13 text-danger');
        label.insertAfter(element);
    },
    highlight: function(element, errorClass) {
        $(element).parent().addClass('validation-error');
        $(element).addClass('border-danger');
    },
    unhighlight: function(element, errorClass) {
        $(element).parent().removeClass('validation-error');
        $(element).removeClass('border-danger');
    }
});
