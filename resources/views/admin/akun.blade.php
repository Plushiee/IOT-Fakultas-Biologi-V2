@extends('admin.templates.main-admin-utama')
@section('title', 'Rumah Hijau Fakultas Biologi | Pengaturan Akun')
@section('css-extras')
    <link rel="stylesheet" href="{{ asset('main/css/dashboard.css') }}">
@endsection
@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.akun.pengaturan') }}">Akun</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pengaturan Akun</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12 col-lg-6 mb-3 mb-lg-0">
            <div class="card shadow" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-12 col-sm-3 col-xxl-4 mb-2 mb-sm-0">
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
                    <p class="small mt-2 mb-0 text-muted">Email</p>
                    <h5 class="mb-3">dann@email.com</h5>
                    <p class="small mt-2 mb-0 text-muted">Fakultas</p>
                    <h5 class="mb-3">Fakultas Teknologi Informasi</h5>
                    <p class="small mt-2 mb-0 text-muted">Prodi</p>
                    <h5 class="mb-3">Sistem Informasi</h5>
                    <p class="small mt-2 mb-0 text-muted">Semester</p>
                    <h5 class="mb-3">7</h5>
                    <p class="small mt-2 mb-0 text-muted">Password</p>
                    <h5 class="mb-3">********</h5>
                    <p class="small mt-2 mb-0 text-muted">Nomor Telepon</p>
                    <h5 class="mb-3">+62 812 3456 7890</h5>

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
            // Script for Number Input
            const $inputNumber = $('#temperature-input');
            const $btnPlus = $('#btn-plus');
            const $btnMinus = $('#btn-minus');

            $inputNumber.on('input', function() {
                const currentValue = parseInt($inputNumber.val());
                const maxValue = parseInt($inputNumber.attr('max'));
                const minValue = parseInt($inputNumber.attr('min'));
                if (currentValue > maxValue) {
                    $inputNumber.val(maxValue);
                } else if (currentValue < minValue) {
                    $inputNumber.val(minValue);
                }
            });

            $btnPlus.on('click', function() {
                const currentValue = parseInt($inputNumber.val());
                const maxValue = parseInt($inputNumber.attr('max'));
                if (currentValue < maxValue) {
                    $inputNumber.val(currentValue + parseInt($inputNumber.attr('step')));
                }
            });

            $btnMinus.on('click', function() {
                const currentValue = parseInt($inputNumber.val());
                const minValue = parseInt($inputNumber.attr('min'));
                if (currentValue > minValue) {
                    $inputNumber.val(currentValue - parseInt($inputNumber.attr('step')));
                }
            });

            // Script untuk kontrol
            var first = true;

            // API mqtt Pompa
            let isAutomatic = false;
            let pumpStatus = 'mati';
            let temperature = 5.0;

            function updateVisibility() {
                if ($('#automatic-switch').is(':checked')) {
                    if (first) {
                        first = false;
                    }
                    $('#pump-control').slideUp();
                    $('#temperature-control, #status-pompa').slideDown();
                    isAutomatic = true;
                } else {
                    $('#pump-control').slideDown();
                    $('#temperature-control, #status-pompa').slideUp();

                }

                if ($('#pump-switch').is(':checked')) {
                    $('#temperature-control, #status-pompa').slideUp();
                    $('#automatic-switch').prop('disabled', true);
                } else {
                    $('#automatic-switch').prop('disabled', false);
                }
            }

            // Initial state with a delay to allow elements to render properly before applying effects
            $('#temperature-control, #status-pompa').hide();
            setTimeout(updateVisibility, 100);

            $('#automatic-switch').change(function() {
                updateVisibility();
            });

            $('#pump-switch').change(function() {
                updateVisibility();
            });

            $('#automatic-switch').change(function() {
                isAutomatic = this.checked;
                if (isAutomatic) {
                    $('#pump-switch').prop('disabled', true);
                    checkTemperature();
                    alert.fire({
                        icon: 'success',
                        title: 'Sistem Otomatisasi Sedang Berjalan!'
                    });
                } else {
                    $('#pump-switch').prop('disabled', false);
                    sendMqttMessage('fakbiologi/pump', 'mati');
                    sendPompaStatus('mati', false);
                    alert.fire({
                        icon: 'warning',
                        title: 'Sistem Otomatisasi Dimatikan!'
                    });
                }
            });

            $('#pump-switch').change(function() {
                if (this.checked) {
                    sendMqttMessage('fakbiologi/pump', 'nyala');
                    sendPompaStatus('nyala');
                    alert.fire({
                        icon: 'success',
                        title: 'Pompa Dinyalakan!'
                    });
                } else {
                    sendMqttMessage('fakbiologi/pump', 'mati');
                    sendPompaStatus('mati');
                    alert.fire({
                        icon: 'warning',
                        title: 'Pompa Dimatikan!'
                    });
                }
            });

            function updatePumpStatus(status) {
                const statusTextElement = $('#pump-status-text');

                if (status === 'nyala') {
                    statusTextElement.html(
                        'Menyala&nbsp;&nbsp; <i class="fa fa-circle green-shadow" aria-hidden="true" id="pump-status-icon"></i>'
                    );
                } else if (status === 'mati') {
                    statusTextElement.html(
                        'Mati&nbsp;&nbsp; <i class="fa fa-circle red-shadow" aria-hidden="true" id="pump-status-icon"></i>'
                    );
                }
            }

            function checkTemperature() {
                if (isAutomatic) {
                    let temperatureThreshold = parseFloat($('#temperature-input').val());

                    if (temperature < temperatureThreshold && pumpStatus !== 'nyala') {
                        sendMqttMessage('fakbiologi/pump', 'nyala');
                        sendPompaStatus('nyala', true);
                        pumpStatus = 'nyala'; // Update status pompa setelah mengirim API
                        updatePumpStatus(pumpStatus);
                    } else if (temperature >= temperatureThreshold && pumpStatus !== 'mati') {
                        sendMqttMessage('fakbiologi/pump', 'mati');
                        sendPompaStatus('mati', true);
                        pumpStatus = 'mati'; // Update status pompa setelah mengirim API
                        updatePumpStatus(pumpStatus);
                    }

                    // Hanya panggil kembali jika status masih otomatis
                    setTimeout(checkTemperature, 2000);
                }
            }


            // Function Send Pompa to Database
            function sendPompaStatus(status, otomatis = false) {
                $.ajax({
                    url: '{{ route('api.post.pompa') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status,
                        otomatis: otomatis,
                        suhu: $('#temperature-input').val()
                    },
                    error: function(response) {
                        alert.fire({
                            icon: 'error',
                            title: 'Gagal mengirim perintah ke API!'
                        });
                    }
                });
            }

            // MQTT Send to API
            function sendMqttMessage(topic, message) {
                $.ajax({
                    url: '{{ route('api.send.mqtt') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        topic: topic,
                        message: message
                    },
                    error: function(response) {
                        alert.fire({
                            icon: 'error',
                            title: 'Gagal mengirim perintah ke MQTT!'
                        });
                    }
                });
            }


            // MQTT Udara
            function updateTemperatureHumidity(temperature, humidity) {
                var displayElement = $("#temperature-humidity-display");
                var currentText = displayElement.html().split("<br>");

                var currentTemperature = parseFloat(currentText[0]) || 0;
                var currentHumidity = parseInt(currentText[1]) || 0;

                if (temperature !== null) {
                    currentTemperature = temperature.toFixed(1) + '° C';
                } else {
                    currentTemperature = currentTemperature.toFixed(1) + '° C';
                }

                if (humidity !== null) {
                    currentHumidity = humidity + '%';
                } else {
                    currentHumidity = currentHumidity + '%';
                }

                displayElement.html(currentTemperature + "<br>" + currentHumidity);
            }

            // MQTT PH
            function updatePH(ph) {
                const asamBasa = document.getElementById('asam-basa');
                var displayElement = $("#ph-display");
                displayElement.html(ph);
                if (ph < 7) {
                    asamBasa.innerHTML = "Asam";
                    asamBasa.style.color = "red";
                } else if (ph > 7) {
                    asamBasa.innerHTML = "Basa";
                    asamBasa.style.color = "blue";
                } else {
                    asamBasa.innerHTML = "Netral";
                    asamBasa.style.color = "black";
                }
            }

            // MQTT Volume
            function updateVolume(tinggi) {
                var displayElement = $("#volume-display");
                let l_alas = 3.14 * (20 / 2) ** 2;
                let volume = l_alas * tinggi;
                let volumeInLiters = volume / 1000;
                displayElement.html(volumeInLiters.toFixed(2));
            }

            // MQTT TDS
            function updateTDS(tds) {
                var displayElement = $("#ppm-display");
                displayElement.html(tds);
            }

            // Script untuk Fluid Meter
            var fm = new FluidMeter();
            fm.init({
                targetContainer: document.getElementById("fluid-meter"),
                fillPercentage: 0,
                options: {
                    fontSize: "55px",
                    fontFamily: "Arial",
                    fontFillStyle: "black",
                    drawShadow: false,
                    drawText: true,
                    drawPercentageSign: true,
                    drawBubbles: true,
                    size: 250,
                    borderWidth: 0,
                    foregroundFluidLayer: {
                        fillStyle: "lightblue",
                        angularSpeed: 100,
                        maxAmplitude: 12,
                        frequency: 40,
                        horizontalSpeed: -150
                    },
                    backgroundFluidLayer: {
                        fillStyle: "blue",
                        angularSpeed: 100,
                        maxAmplitude: 9,
                        frequency: 30,
                        horizontalSpeed: 150
                    }
                }
            });

            // Script for Chart Waterflow
            var config = {
                type: 'gauge',
                data: {
                    labels: ['Mati', 'Cukup', 'Bagus'],
                    datasets: [{
                        data: [0, 250, 500, 750, 1000],
                        value: 0,
                        backgroundColor: ['red', 'red', 'orange', 'yellow', 'green'],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    title: {
                        display: false
                    },
                    layout: {
                        padding: {
                            bottom: 30
                        }
                    },
                    needle: {
                        radiusPercentage: 2,
                        widthPercentage: 3.2,
                        lengthPercentage: 80,
                        color: 'rgba(0, 0, 0, 1)'
                    },
                    valueLabel: {
                        display: true,
                        formatter: (value) => {
                            return Math.round(value) + ' ml/s';
                        }
                    }
                }
            };

            window.onload = function() {
                var ctx = document.getElementById('chart').getContext('2d');
                window.myGauge = new Chart(ctx, config);
            };

            function updateTime() {
                const timeElement = document.getElementById('current-time');
                const iconElement = document.getElementById('time-icon');
                const now = new Date();
                const hours = now.getHours();
                const minutes = now.getMinutes();
                const seconds = now.getSeconds();
                const formattedTime =
                    `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')} WIB`;

                timeElement.textContent = formattedTime;

                if (hours >= 6 && hours < 18) { // Pagi (06:00 - 18:00)
                    iconElement.className = 'fas fa-sun icon-sun';
                } else { // Malam
                    iconElement.className = 'fas fa-moon icon-moon';
                }
            }

            // Update waktu setiap detik
            setInterval(updateTime, 1000);

            // Update waktu saat halaman dimuat
            updateTime();

            // API waktu
            const apiKey = '5ab3a993f24b4255a8f64611240107';
            const city = 'Kotabaru,Yogyakarta';
            const apiUrl =
                `https://api.weatherapi.com/v1/forecast.json?key=${apiKey}&q=${city}&days=1&aqi=no&alerts=no}`;

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    const weatherIcon = document.getElementById('weather-icon');
                    const weatherDescription = document.getElementById('weather-description');

                    const iconUrl = data.current.condition.icon;
                    weatherIcon.src = iconUrl;
                    weatherDescription.textContent = data.current.condition.text;
                })
                .catch(error => console.error('Error fetching weather data:', error));

            // SSE Start
            // Inisialisasi EventSource
            // const eventSource = new EventSource("{{ route('api.get.sse') }}");

            // eventSource.onmessage = function(event) {
            //     const response = JSON.parse(event.data);

            //     updateTemperatureHumidity(response.tempHum.temperature, response.tempHum.humidity);
            //     const temperature = response.tempHum.temperature;
            //     updatePH(response.ph);
            //     updateVolume(response.arusAir);
            //     updateTDS(response.tds);
            //     checkTemperature();

            //     window.myGauge.data.datasets[0].value = response.arusAir;
            //     window.myGauge.update();
            //     fm.setPercentage(response.ping);
            // };

            // // Error Handler SSE
            // eventSource.onerror = function(error) {
            //     console.error("SSE connection error:", error);

            //     // Optional: Menutup koneksi jika error
            //     // eventSource.close();
            // };
            // SSE End
        });
    </script>
@endsection
