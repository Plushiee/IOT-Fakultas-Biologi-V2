@extends('main.templates.main-admin-utama')
@section('title', 'Rumah Hijau Fakultas Biologi | Dashboard')
@section('css-extras')
    <link rel="stylesheet" href="{{ asset('main/css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMm8gYhj6C+lVV1+ENLMBqI1n5DJRA5/tv8Z9o4" crossorigin="anonymous">
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
    </style>
@endsection
@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
    <div class="row mb-2">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner carousel-inner-card py-0 px-4" style="height: 195px">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-6">
                            <div class="card card-carousel rounded">
                                <div class="card-body card-body-carousel">
                                    <h5 class="card-title mb-3 text-center text-sm-start">Waktu</h5>
                                    <div class="text-center">
                                        <h1><i id="time-icon" class="fas"></i>
                                            <h1>
                                    </div>
                                    <p id="current-time" class="card-text text-center"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 pe-4">
                            <div class="card card-carousel rounded">
                                <div class="card-body card-body-carousel">
                                    <h5 class="card-title mb-3">Cuaca</h5>
                                    <div id="weather-info" class="d-flex align-items-center text-center">
                                        <img id="weather-icon" src="" alt="Weather Icon" class="img-fluid"
                                            style="max-width: 100px; max-height: 85px; margin: 0 auto; display: block;">
                                    </div>
                                    <p id="weather-description" class="card-text text-center"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-6">
                            <div class="card card-carousel rounded">
                                <div class="card-body card-body-carousel">
                                    <h5 class="card-title mb-3">Udara</h5>
                                    <div class="text-center my-2">
                                        <h1 id="temperature-humidity-display">00.0° C<br>00% </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 pe-4">
                            <div class="card card-carousel rounded">
                                <div class="card-body card-body-carousel">
                                    <h5 class="card-title mb-3">PH</h5>
                                    <div class="text-center my-4">
                                        <h1 id="ph-display">0.0 </h1>
                                    </div>
                                    <p class="card-text text-center pt-2 fw-bold" id="asam-basa">-</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-6">
                            <div class="card card-carousel rounded">
                                <div class="card-body card-body-carousel">
                                    <h5 class="card-title mb-3">Volume</h5>
                                    <div class="text-center my-4">
                                        <h1 id="volume-display">0000</h1>
                                    </div>
                                    <p class="card-text text-center pt-2">Liter</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 pe-4">
                            <div class="card card-carousel rounded">
                                <div class="card-body card-body-carousel">
                                    <h5 class="card-title mb-3">TDS</h5>
                                    <div class="text-center my-4">
                                        <h1 id="ppm-display">0000</h1>
                                    </div>
                                    <p class="card-text text-center pt-2">PPM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev carousel-control-prev-card" type="button"
                data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next carousel-control-next-card" type="button"
                data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-6 mb-3 mb-lg-0">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Informasi Air</h3>
                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="container-fluid d-flex justify-content-center align-items-center"
                                    style="height: 300px;">
                                    <div class="text-center">
                                        <p class="card-text m-0">Daya Tampung Air</p>
                                        <div id="fluid-meter" style="margin: 0 auto;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="container-fluid d-flex justify-content-center align-items-center"
                                    style="height: 300px;">
                                    <div class="text-center">
                                        <p class="card-text mb-2">Debit Air</p>
                                        <div id="canvas-holder" style="width:100%">
                                            <canvas class="small-chart" id="chart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 d-none">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Kontrol</h3>
                    <div class="row align-items-center">
                        <div class="col-8">
                            <div class="container-fluid">
                                <p class="card-text text-start">Otomatis</p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="container-fluid">
                                <div class="form-check form-switch float-end">
                                    <input class="form-check-input" type="checkbox" role="switch" id="automatic-switch"
                                        {{ $pompaStatus->otomatis == true ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center" id="temperature-control">
                        <div class="col-6 col-sm-7 col-md-9 col-lg-8 col-xl-6">
                            <div class="container-fluid">
                                <p class="card-text text-start">Suhu Menyala</p>
                            </div>
                        </div>
                        <div class="col-6 col-sm-5 col-md-3 col-lg-4 col-xl-6">
                            <div class="container-fluid">
                                <div class="input-group custom-height p-0 mx-2">
                                    <button class="btn btn-outline-secondary" type="button" id="btn-minus">
                                        <i class="fa fa-minus-circle"></i>
                                    </button>
                                    <input type="number" class="form-control custom-height"
                                        value="{{ $pompaStatus->suhu }}" min="0" max="100" step="1"
                                        id="temperature-input">
                                    <button class="btn btn-outline-secondary" type="button" id="btn-plus">
                                        <i class="fa fa-plus-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center mt-1" id="status-pompa">
                        <div class="col-6 col-sm-7 col-md-9 col-lg-8 col-xl-4 col-xxl-8">
                            <div class="container-fluid">
                                <p class="card-text text-start">Status Pompa</p>
                            </div>
                        </div>
                        <div class="col-6 col-sm-5 col-md-3 col-lg-4 col-xl-8 col-xxl-4 ps-0">
                            <div class="container-fluid">
                                <p class="card-text text-end mx-2 fw-bold" id="pump-status-text">
                                    Mati&nbsp;&nbsp; <i class="fa fa-circle red-shadow" aria-hidden="true"
                                        id="pump-status-icon"></i>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center" id="pump-control">
                        <div class="col-8">
                            <div class="container-fluid">
                                <p class="card-text text-start">Pompa</p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="container-fluid">
                                <div class="form-check form-switch float-end">
                                    <input class="form-check-input" type="checkbox" role="switch" id="pump-switch"
                                        @if ($pompaStatus->status == 'nyala' && $pompaStatus->otomatis == false) checked @endif>
                                </div>
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
                const statusIconElement = $('#pump-status-icon');

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

            // Alert SweetAlert2
            $('#btn-login').click(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Login',
                    html: `
                    <form id="login-form">
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password">
                        </div>
                    </form>
                `,
                    showCancelButton: true,
                    confirmButtonText: 'Login',
                    preConfirm: () => {
                        const username = document.getElementById('username').value;
                        const password = document.getElementById('password').value;

                        if (!username || !password) {
                            Swal.showValidationMessage(
                                'Please enter both username and password');
                            return false;
                        }

                        // Return data for further processing
                        return {
                            username,
                            password
                        };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log('Login data:', result.value);

                        // Example: AJAX request (adjust URL and data as needed)
                        fetch('/login', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]')
                                        .content
                                },
                                body: JSON.stringify(result.value)
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Success', 'Login successful!', 'success');
                                } else {
                                    Swal.fire('Error', data.message, 'error');
                                }
                            })
                            .catch(error => {
                                Swal.fire('Error', 'An error occurred!', 'error');
                            });
                    }
                });
            });
        });
    </script>
@endsection
