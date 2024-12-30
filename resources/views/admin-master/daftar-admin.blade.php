@extends('admin-master.templates.main-admin-utama')
@section('title', 'Rumah Hijau Fakultas Biologi | Daftar Admin')
@section('css-extras')
    <!-- Core Bootstrap Table -->
    <link rel="stylesheet" href="{{ asset('main/css/bootstrap-table.css') }}">
    <!-- /Core Bootstrap Table -->
    <link rel="stylesheet" href="{{ asset('main/css/tabel.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .swal2-html-container {
            padding-top: 0;
        }

        #hari-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .hari-box {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 40px;
            background-color: #ffffff;
            border: 1px solid #008000;
            color: #008000;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            user-select: none;
        }

        .hari-box.active {
            background-color: #008000;
            color: white;
            border-color: #008000;
        }
    </style>
@endsection
@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Admin</li>
        </ol>
    </nav>
    <div class="row mb-1">
        <div class="col-12">
            <div id="toolbar" class="select">
                <select class="form-control">
                    <option value="">Export (Hanya yang Ditampilkan)</option>
                    <option value="all">Export (Semua)</option>
                    <option value="selected">Export (Yang Dipilih)</option>
                </select>
            </div>

            <table id="table" data-show-export="true" data-pagination="true"
                data-page-list="[10, 25, 50, 100, 200, ALL]" data-click-to-select="true" data-toolbar="#toolbar"
                data-search="true" data-show-toggle="true" data-show-columns="true" data-ajax="APIGetUser">
            </table>

            <button class="btn btn-success float-end" id="tambah-akun">Tambah Akun Admin</button>
        </div>
    </div>
@endsection

@section('jQuery-extras')
    <!-- Core Bootstrap Table -->
    <script src="{{ asset('main/js/bootstrap-table.js') }}"></script>
    <script src="{{ asset('main/js/table-export/jsPDF/polyfills.umd.min.js') }}"></script>
    <script src="{{ asset('main/js/bootstrap-table-export.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.29.0/tableExport.min.js"></script>
    <script src="{{ asset('main/js/table-export/jsPDF/jspdf.umd.min.js') }}"></script>
    <script src="{{ asset('main/js/table-export/FileSaver/FileSaver.min.js') }}"></script>
    <script src="{{ asset('main/js/table-export/js-xlsx/xlsx.core.min.js') }}"></script>
    <script src="{{ asset('main/js/table-export/html2canvas/html2canvas.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- /Core Bootstrap Table -->
    <script>
        var $table = $('#table');
        $(function() {
            $('#toolbar').find('select').change(function() {
                $table.bootstrapTable('destroy').bootstrapTable({
                    exportDataType: $(this).val(),
                    exportTypes: ['json', 'xml', 'csv', 'txt', 'sql', 'excel', 'pdf'],
                    columns: [{
                            field: 'state',
                            checkbox: true,
                            visible: $(this).val() === 'selected'
                        },
                        {
                            field: 'no',
                            title: 'No',
                            align: 'center',
                            formatter: function(value, row, index) {
                                return index + 1;
                            }
                        },
                        {
                            field: 'email',
                            title: 'Email',
                            align: 'center'
                        },
                        {
                            field: 'nama',
                            title: 'Nama',
                            align: 'center'
                        },
                        {
                            field: 'nomor_telepon',
                            title: 'Nomor Telepon',
                            align: 'center',
                            formatter: function(value, row, index) {
                                return '+62' + value;
                            }
                        },
                        {
                            field: 'role',
                            title: 'Jabatan',
                            align: 'center',
                            formatter: function(value, row, index) {
                                return value === 'admin' ? 'Botanist' : 'Senior Botanist';
                            }
                        },
                        {
                            field: 'hari',
                            title: 'Hari',
                            align: 'center',
                            formatter: function(value, row, index) {
                                const hariArray = JSON.parse(value);

                                return `
                                    ${hariArray.join(', ')}
                                    <br>
                                    <a href="#" class="btn btn-warning edit-waktu mt-1" data-id="${row.id}" data-hari='${JSON.stringify(hariArray)}'>
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>`;
                            }
                        },
                        {
                            field: 'jam',
                            title: 'Jam',
                            align: 'center',
                            formatter: function(value, row, index) {
                                return `
                                    ${value.s} - ${value.e}
                                    <br>
                                    <a href="#" class="btn btn-warning edit-jam mt-1" data-id="${row.id}" data-s="${value.s}" data-e="${value.e}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                `;
                            }

                        },
                        {
                            field: 'password',
                            title: 'Password',
                            align: 'center',
                            formatter: function(value, row, index) {
                                return `
                                    <button class="btn btn-warning reset_password" data-id="${row.id}" data-nama="${row.nama}">
                                        <i class="fa-solid fa-key"></i> Reset Password
                                    </button>
                                `;
                            }
                        },
                        {
                            field: 'aksi',
                            title: 'Aksi',
                            align: 'center',
                            formatter: function(value, row, index) {
                                return `
                                <div class="d-grid gap-2 mt-2">
                                    <a href="#" class="btn btn-success view" data-id="${row.id}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger delete" data-id="${row.id}" data-nama="${row.nama}">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>
                                `;
                            }
                        }

                    ],
                    data: []
                });

                // Re-initialize export buttons
                $table.bootstrapTable('refreshOptions', {
                    exportDataType: $(this).val()
                });
            }).trigger('change');
        });

        function APIGetUser(params) {
            $.ajax({
                type: "POST",
                url: "{{ route('api.get.user') }}",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                dataType: "json",
                success: function(data) {
                    params.success(data);
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);
                    console.error("Status: " + status);
                    console.dir(xhr);
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#tambah-akun').click(function(e) {
                e.preventDefault();
            });

            $(document).on('click', '.view', function(e) {
                e.preventDefault();

                const id = $(this).data('id');
                const url =
                    "{{ route('admin-master.akun.daftar-admin.view', ['id' => ':id']) }}"
                    .replace(
                        ':id', id);
                window.open(url, '_blank');
            });

            $(document).on('click', '.delete', function(e) {
                e.preventDefault();

                const userId = $(this).data('id');
                const nama = $(this).data('nama');

                Swal.fire({
                    title: 'Delete Admin',
                    html: `
                        <p class="mt-2 mx-2 mb-1 pb-0">Apakah Anda yakin ingin menghapus admin bernama <strong>${nama}</strong>?</p>
                        <p class="fw-bold text-danger mx-2 mb-0 pb-0">Data yang dihapus tidak dapat dipulihkan kembali.</p>
                    `,
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `{{ route('api.admin-utama.delete.admin') }}`,
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                id: userId,
                            },
                            success: function(response) {
                                alert.fire({
                                    icon: 'success',
                                    title: response.message,
                                });
                            },
                            error: function(xhr) {
                                alert.fire({
                                    icon: 'error',
                                    title: xhr.responseJSON?.message ||
                                        'Terdapat suatu kesalahan. Mohon input ulang.',
                                });
                            },
                        });
                    }
                });
            });

            $(document).on('click', '.reset_password', function(e) {
                e.preventDefault();

                const userId = $(this).data('id');
                const nama = $(this).data('nama');

                Swal.fire({
                    title: 'Reset Password',
                    html: `
                        <p class="mt-2 mx-2 pb-0 mb-0">Apakah Anda yakin ingin mereset password admin <strong>${nama}</strong>?</p>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Reset',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `{{ route('api.admin-utama.update.reset-password') }}`,
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                id: userId,
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    icon: 'success',
                                    html: `
                                    <p class="mb-2">Password Baru Pengguna</p>
                                       <div class="input-group">
                                            <p class="form-control mb-0 ps-5 fw-bold">${response.new_password}</p>
                                            <span class="input-group-text copy-icon" id="basic-addon2" style="cursor: pointer;">
                                                <i class="bi bi-clipboard-fill"></i>
                                            </span>
                                        </div>
                                    `,
                                    confirmButtonText: 'Tutup',
                                });

                                $(document).on('click', '.copy-icon', function() {
                                    const passwordText =
                                        `${response.new_password}`;
                                    navigator.clipboard.writeText(passwordText)
                                        .then(() => {
                                            const iconElement = $(this)
                                                .find('i');
                                            iconElement.removeClass(
                                                    'bi-clipboard-fill')
                                                .addClass(
                                                    'bi-clipboard2-check-fill'
                                                );

                                            let messageElement = $(this)
                                                .closest('.input-group')
                                                .next('.copy-message');
                                            if (!messageElement.length) {
                                                messageElement = $(
                                                    '<div class="copy-message text-success mt-2">Password telah disalin!</div>'
                                                );
                                                $(this).closest(
                                                        '.input-group')
                                                    .after(messageElement);
                                            }

                                            setTimeout(() => {
                                                    iconElement
                                                        .removeClass(
                                                            'bi-clipboard2-check-fill'
                                                        ).addClass(
                                                            'bi-clipboard-fill'
                                                        );
                                                    messageElement
                                                        .fadeOut(500,
                                                            function() {
                                                                $(this)
                                                                    .remove();
                                                            });
                                                },
                                                2000);
                                        }).catch(() => {
                                            console.error(
                                                'Gagal menyalin ke clipboard.'
                                            );
                                        });
                                });
                            },
                            error: function() {
                                alert.fire({
                                    icon: 'error',
                                    title: xhr.responseJSON?.message ||
                                        'Terdapat suatu kesalahan. Mohon input ulang.',
                                });
                            },
                        });
                    }
                });
            });

            $(document).on('click', '.edit-waktu', function(e) {
                e.preventDefault();

                const id = $(this).data('id');
                const hariArray = $(this).data('hari');
                const hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

                const hariBoxes = hariList.map(hari => `
                    <div class="hari-box ${hariArray.includes(hari) ? 'active' : ''}" data-hari="${hari}">
                        ${hari}
                    </div>
                `).join('');

                Swal.fire({
                    title: 'Edit Hari',
                    html: `
                        <div id="hari-container">
                            ${hariBoxes}
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Simpan',
                    didOpen: () => {
                        $('.hari-box').on('click', function() {
                            $(this).toggleClass('active');
                        });
                    },
                    preConfirm: () => {
                        const selectedHari = [];
                        $('.hari-box.active').each(function() {
                            selectedHari.push($(this).data('hari'));
                        });

                        if (selectedHari.length === 0) {
                            alert.fire({
                                icon: 'error',
                                title: 'Harap pilih minimal satu hari!',
                            });
                            return false;
                        }

                        return selectedHari;
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const updatedHari = result.value;

                        $.ajax({
                            url: `{{ route('api.admin-utama.update.hari-kerja') }}`,
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                id: id,
                                hari: JSON.stringify(updatedHari),
                            },
                            success: function(response) {
                                alert.fire({
                                    icon: 'success',
                                    title: response.message,
                                });
                                $('#table').bootstrapTable('refresh');
                            },
                            error: function(xhr) {
                                alert.fire({
                                    icon: 'error',
                                    title: xhr.responseJSON?.message ||
                                        'Terdapat suatu kesalahan. Mohon input ulang.',
                                });
                            }
                        });
                    }
                });
            });

            $(document).on('click', '.edit-jam', function(e) {
                e.preventDefault();

                const id = $(this).data('id');
                const start = $(this).data('s');
                const end = $(this).data('e');

                Swal.fire({
                    title: 'Edit Jam Kerja',
                    html: `
                    <div class="d-flex justify-content-center gap-3">
                        <div class="form-group">
                            <label for="start-time" class="form-label">Jam Mulai</label>
                            <input type="text" id="start-time" class="form-control text-center" value="${start}">
                        </div>
                        <div class="form-group">
                            <label for="end-time" class="form-label">Jam Selesai</label>
                            <input type="text" id="end-time" class="form-control text-center" value="${end}">
                        </div>
                    </div>
                        `,
                    showCancelButton: true,
                    confirmButtonText: 'Simpan',
                    preConfirm: () => {
                        const startTime = $('#start-time').val();
                        const endTime = $('#end-time').val();

                        if (!startTime || !endTime) {
                            alert.fire({
                                icon: 'error',
                                title: 'Harap isi semua kolom!',
                            });
                            return false;
                        }

                        return {
                            start: startTime,
                            end: endTime
                        };
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        const updatedTime = result.value;

                        // Kirim data ke server dengan AJAX
                        $.ajax({
                            url: `{{ route('api.admin-utama.update.jam-kerja') }}`,
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                id: id,
                                start: updatedTime.start,
                                end: updatedTime.end,
                            },
                            success: function(response) {
                                alert.fire({
                                    icon: 'success',
                                    title: response.message,
                                });
                                // Reload table atau update row
                                $('#table').bootstrapTable('refresh');
                            },
                            error: function(xhr) {
                                alert.fire({
                                    icon: 'error',
                                    title: xhr.responseJSON?.message ||
                                        'Terdapat suatu kesalahan. Mohon input ulang.',
                                });
                            }
                        });
                    }
                });

                // Inisialisasi flatpickr setelah SweetAlert2 muncul
                flatpickr('#start-time', {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i"
                });
                flatpickr('#end-time', {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i"
                });
            });
        });
    </script>
@endsection
