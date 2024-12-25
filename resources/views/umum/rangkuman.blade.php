@extends('umum.templates.main-umum-utama')
@section('title', 'Rumah Hijau Fakultas Biologi | Rangkuman')
@section('css-extras')
    <link rel="stylesheet" href="{{ asset('main/css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMm8gYhj6C+lVV1+ENLMBqI1n5DJRA5/tv8Z9o4" crossorigin="anonymous">
    <!-- CSS untuk Bootstrap Datepicker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <style>
        /* Floating Button Styling */
        .floating-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #077f0d;
            color: #fff;
            border: none;
            border-radius: 15%;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .floating-btn:hover {
            background-color: #0056b3;
        }

        #dateFilters {
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            background-color: #f8f9fa;
        }
    </style>
@endsection
@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Rangkuman</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div
                            class="col-12 col-sm-9 col-xl-10 d-flex align-items-center justify-content-center justify-content-sm-start">
                            <h3 class="text-center text-sm-start">Rangkuman Data</h3>
                        </div>
                        <div
                            class="col-12 col-sm-3 col-xl-2 d-flex align-items-center justify-content-center justify-content-sm-end pe-2">
                            <button id="toggleFilters" class="btn btn-primary w-100 w-sm-auto">
                                Filter
                            </button>
                        </div>
                    </div>
                    <div class="row my-2 py-2" id="dateFilters" style="display: none;">
                        <div class="col-12 col-sm-6">
                            <label for="startDate" class="form-label">Tanggal Mulai :</label>
                            <input type="text" id="startDate" class="form-control datepicker"
                                placeholder="Pilih tanggal mulai">
                        </div>
                        <div class="col-12 col-sm-6 mt-2 mt-sm-0">
                            <label for="endDate" class="form-label">Tanggal Selesai :</label>
                            <input type="text" id="endDate" class="form-control datepicker"
                                placeholder="Pilih tanggal selesai">
                        </div>
                        <div class="text-end mt-3">
                            <button id="applyFilter" class="btn btn-primary">Terapkan Filter</button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <canvas id="chartAll"></canvas>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <canvas id="chartArus"></canvas>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <canvas id="chartTempHumidity"></canvas>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <canvas id="chartTDS"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Button Login -->
    <button class="floating-btn" id="btn-login">
        🔑
    </button>
@endsection

@section('jQuery-extras')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- JavaScript Bootstrap Datepicker -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

    <script>
        $(document).ready(function() {
            // Menampilkan atau menyembunyikan dropdown
            $('#toggleFilters').on('click', function() {
                $('#dateFilters').slideToggle();
            });

            // Hitung tanggal hari ini dan 32 hari ke belakang
            const today = new Date();
            const pastDate = new Date();
            pastDate.setDate(today.getDate() - 32);

            // Inisialisasi Datepicker dengan rentang tanggal
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                clearBtn: true,
                startDate: pastDate,
                endDate: today
            });

            // Validasi filter
            $('#applyFilter').on('click', function() {
                const startDate = $('#startDate').val();
                const endDate = $('#endDate').val();

                if (!startDate || !endDate || startDate > endDate) {
                    alert('Harap pilih rentang tanggal yang valid!');
                    return;
                }

                const url = new URL(window.location.href);
                url.searchParams.set('s', startDate);
                url.searchParams.set('e', endDate);
                window.location.href = url.toString();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            const data = @json($data);

            // Fungsi untuk membuat grafik
            function createChart(context, type, labels, datasets, options = {}) {
                return new Chart(context, {
                    type: type,
                    data: {
                        labels: labels,
                        datasets: datasets
                    },
                    options: $.extend({
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true
                            }
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Tanggal'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Nilai'
                                }
                            }
                        }
                    }, options)
                });
            }

            // Grafik TDS
            createChart(
                $('#chartTDS'),
                'line',
                Object.keys(data.tds),
                [{
                    label: 'TDS (ppm)',
                    data: Object.values(data.tds),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 1
                }]
            );

            // Grafik Arus
            createChart(
                $('#chartArus'),
                'line',
                Object.keys(data.arus),
                [{
                    label: 'Arus (Debit)',
                    data: Object.values(data.arus),
                    borderColor: 'rgba(153, 102, 255, 1)',
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderWidth: 1
                }]
            );

            // Grafik Temperature dan Humidity
            createChart(
                $('#chartTempHumidity'),
                'line',
                Object.keys(data.temperature),
                [{
                        label: 'Temperature (°C)',
                        data: Object.values(data.temperature),
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderWidth: 1
                    },
                    {
                        label: 'Humidity (%)',
                        data: Object.values(data.humidity),
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 1
                    }
                ]
            );

            // Grafik Gabungan Semua
            createChart(
                $('#chartAll'),
                'line',
                Object.keys(data.temperature), // Gunakan tanggal yang sama untuk semua
                [{
                        label: 'TDS (ppm)',
                        data: Object.values(data.tds),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 1
                    },
                    {
                        label: 'Arus (Debit)',
                        data: Object.values(data.arus),
                        borderColor: 'rgba(153, 102, 255, 1)',
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderWidth: 1
                    },
                    {
                        label: 'Temperature (°C)',
                        data: Object.values(data.temperature),
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderWidth: 1
                    },
                    {
                        label: 'Humidity (%)',
                        data: Object.values(data.humidity),
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 1
                    }
                ]
            );
        });
    </script>
@endsection
