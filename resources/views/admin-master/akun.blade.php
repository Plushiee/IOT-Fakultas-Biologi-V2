@extends('admin-master.templates.main-admin-utama')
@section('title', 'Rumah Hijau Fakultas Biologi | Pengaturan Akun')
@section('css-extras')
    <link rel="stylesheet" href="{{ asset('main/css/dashboard.css') }}">
@endsection
@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin-master.akun.pengaturan') }}">Akun</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pengaturan Akun</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12 col-lg-6 mb-3 mb-lg-0">
            <div class="card shadow" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-12 col-sm-3 col-xxl-4 mb-2 mb-sm-0 text-center">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp"
                                alt="Generic placeholder image" class="img-fluid"
                                style="width: 190px; height: 210px; border-radius: 10px;" />
                        </div>

                        <div class="col-12 col-sm-9 col-xxl-8">
                            <h3 class="mb-1 text-sm-start text-center">Danny McLoan</h3>
                            <p class="mb-2 pb-1 text-sm-start text-center">
                                Senior Botanist
                            </p>
                            <div class="d-flex justify-content-start rounded-3 p-2 mb-2 bg-body-tertiary">
                                <div class="row">
                                    <div class="col-8">
                                        <p class="small text-muted mb-1">
                                            Hari Jaga
                                        </p>
                                        <p class="mb-0">Senin, Selasa, Rabu, Kamis, Jumat, Sabtu, Minggu</p>
                                    </div>
                                    <div class="col-4">
                                        <p class="small text-muted mb-1">
                                            Waktu
                                        </p>
                                        <p class="mb-0">976</p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex pt-1">
                                <button type="button" data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-secondary me-1 flex-grow-1">
                                    Ganti Photo Profile
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6 mb-3 mb-lg-0">
            <div class="card shadow" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <h3>Data Akun</h3>
                    <hr class="mt-2 mb-0 border border-light-subtle border-1 opacity-100">
                    <p class="small mt-2 mb-0 text-muted">Email<a href="#" class="float-end" id="email">edit</a>
                    </p>
                    <h5 class="mb-3">dann@email.com</h5>
                    <p class="small mt-2 mb-0 text-muted">Fakultas<a href="#" class="float-end"
                            id="fakultas">edit</a></p>
                    <h5 class="mb-3">Fakultas Teknologi Informasi</h5>
                    <p class="small mt-2 mb-0 text-muted">Prodi<a href="#" class="float-end" id="prodi">edit</a>
                    </p>
                    <h5 class="mb-3">Sistem Informasi</h5>
                    <p class="small mt-2 mb-0 text-muted">Semester<a href="#" class="float-end"
                            id="semester">edit</a></p>
                    <h5 class="mb-3">7</h5>
                    <p class="small mt-2 mb-0 text-muted">Password<a href="#" class="float-end"
                            id="password">edit</a></p>
                    <h5 class="mb-3">********</h5>
                    <p class="small mt-2 mb-0 text-muted">Nomor Telepon<a href="#" class="float-end"
                            id="nomor_telepon">edit</a></p>
                    <h5 class="mb-0">+6281234567890</h5>
                    <p class="small mt-0 mb-0 text-muted"><a href="#">Hubungi Melalui Whatsapp</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jQuery-extras')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('main/js/js-fluid-meter.js') }}"></script>
    <script src="https://code.jscharting.com/latest/jscharting.js"></script>
    <script type="text/javascript" src="https://code.jscharting.com/latest/modules/types.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"
        integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/chart.js@2.8.0/dist/Chart.bundle.js"></script>
    <script src="https://unpkg.com/chartjs-gauge@0.3.0/dist/chartjs-gauge.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
    <script>
        $(document).ready(function() {
            $('a[id]').on('click', function(e) {
                e.preventDefault(); // Mencegah default action dari anchor tag

                const $anchor = $(this); // Referensi anchor yang diklik
                const fieldId = $anchor.attr('id'); // Mendapatkan ID anchor
                const $label = $anchor.closest('p').next('h5'); // Elemen h5 berikutnya yang akan diubah

                // Cek jika elemen sudah berupa input, maka jangan ubah lagi
                if ($anchor.data('editing')) {
                    // Jika sedang dalam mode editing, ini adalah aksi "Cancel"
                    const originalValue = $anchor.data('originalValue'); // Ambil nilai awal
                    $label.text(originalValue); // Kembalikan nilai awal ke elemen h5
                    $anchor.text('edit').css('color', ''); // Kembalikan teks anchor ke "edit"
                    $anchor.removeData('editing').removeData('originalValue'); // Hapus data tambahan
                    return;
                }

                // Simpan nilai asli untuk aksi Cancel
                let currentValue = $label.text().trim();
                $anchor.data('originalValue', currentValue);
                $anchor.data('editing', true); // Tandai bahwa elemen sedang dalam mode editing

                const inputType = fieldId === 'password' ? 'password' : 'text'; // Tentukan tipe input
                let input = null
                if (fieldId === 'nomor_telepon') {
                    currentValue = currentValue.replace(/^\+62/, "");
                    input = $(
                            `<div class="input-group">
                                <span class="input-group-text" id="basic-addon1">+62</span>
                                <input type="tel" class="form-control" id="input_${fieldId}" value=${currentValue} />
                            </div>`);
                } else {
                    input = $(
                            `<input type="${inputType}" class="form-control" id="input_${fieldId}" />`)
                        .val(currentValue);
                }

                // Ganti isi h5 dengan input
                $label.html(input);

                // Jika password, tambahkan confirm password
                let confirmInput = null;
                if (fieldId === 'password') {
                    confirmInput = $(
                        `<input type="password" class="form-control mt-2" id="confirm_${fieldId}" placeholder="Confirm Password" />`
                    );
                    $label.append(confirmInput); // Tambahkan confirm password input
                }

                // Ubah teks anchor menjadi "Cancel" dengan warna merah
                $anchor.text('Cancel').css('color', 'red');

                // Tambahkan tombol simpan
                const saveButton = $(`<button class="btn btn-sm btn-primary mt-2">Save</button>`);
                $label.append(saveButton);

                // Tambahkan event untuk menyimpan perubahan
                saveButton.on('click', function() {
                    const newValue = input.val().trim(); // Ambil nilai dari input
                    if (fieldId === 'password') {
                        const confirmValue = confirmInput.val()
                            .trim(); // Ambil nilai dari confirm password

                        if (newValue !== confirmValue) {
                            // Tampilkan alert jika password tidak sesuai
                            alert.fire({
                                icon: 'error',
                                title: 'Password tidak cocok!',
                            });
                            return;
                        }
                    }

                    $label.text(newValue); // Kembalikan elemen h5 ke teks baru
                    $anchor.text('edit').css('color', ''); // Kembalikan anchor ke teks "edit"
                    $anchor.removeData('editing').removeData(
                        'originalValue'); // Hapus data tambahan
                });
            });
        });
    </script>
@endsection
