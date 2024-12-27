@extends('umum.templates.main-umum-utama')
@section('title', 'Rumah Hijau Fakultas Biologi | Dashboard')
@section('css-extras')
    <link rel="stylesheet" href="{{ asset('main/css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                                    <h5 class="card-title mb-3">Status Mesin</h5>
                                    <div class="text-center my-4">
                                        <h1 id="status"><i class="fa fa-circle red-shadow" aria-hidden="true"
                                                id="iot-status-icon"></i>&nbsp;&nbsp; Offline</h1>
                                    </div>
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
    </div>
@endsection

@section('jQuery-extras')
    <script src="https://cdn.jsdelivr.net/npm/lodash/lodash.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <script src="{{ asset('main/js/js-fluid-meter.js') }}"></script>
    <script src="https://code.jscharting.com/latest/jscharting.js" defer></script>
    <script type="text/javascript" src="https://code.jscharting.com/latest/modules/types.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"
        integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/chart.js@2.8.0/dist/Chart.bundle.js" defer></script>
    <script src="https://unpkg.com/chartjs-gauge@0.3.0/dist/chartjs-gauge.js" defer></script>
    <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js" defer></script>
    <script>
        $(document).ready(function() {
            // MQTT Udara
            function updateTemperatureHumidity(temperature, humidity) {
                var displayElement = $("#temperature-humidity-display");
                var currentText = displayElement.html().split("<br>");

                var currentTemperature = parseFloat(currentText[0]) || 0;
                var currentHumidity = parseInt(currentText[1]) || 0;

                if (temperature !== null) {
                    currentTemperature = temperature + '° C';
                } else {
                    currentTemperature = currentTemperature + '° C';
                }

                if (humidity !== null) {
                    currentHumidity = humidity + '%';
                } else {
                    currentHumidity = currentHumidity + '%';
                }

                displayElement.html(currentTemperature + "<br>" + currentHumidity);
            }

            // MQTT Status
            function updateStatus(status) {
                var displayElement = $("#status");
                if (status == 1) {
                    displayElement.html(
                        "<i class='fa fa-circle green-shadow' aria-hidden='true' id='iot-status-icon'></i>&nbsp;&nbsp; Online"
                    );
                } else {
                    displayElement.html(
                        "<i class='fa fa-circle red-shadow' aria-hidden='true' id='iot-status-icon'></i>&nbsp;&nbsp; Offline"
                    );
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
            var ctx = document.getElementById('chart').getContext('2d');
            window.myGauge = new Chart(ctx, config);

            setInterval(() => {
                const now = new Date();
                const hours = now.getHours();
                const minutes = now.getMinutes();
                const seconds = now.getSeconds();
                $('#current-time').text(
                    `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')} WIB`
                );
                $('#time-icon').attr('class', hours >= 6 && hours < 18 ? 'fas fa-sun icon-sun' :
                    'fas fa-moon icon-moon');
            }, 1000);

            // API weather
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

            // EventSource (SSE) with Throttling
            const eventSource = new EventSource("{{ route('api.get.sse') }}");
            let retryTimeout = 1000; // Start with 1 second for reconnection attempts

            const throttledUpdate = _.throttle((event) => {
                try {
                    const data = JSON.parse(event.data);

                    updateTemperatureHumidity(data.tempHum?.temperature ?? null, data.tempHum?.humidity ??
                        null);
                    updateVolume(data.arusAir || 0);
                    updateTDS(data.tds || 0);

                    window.myGauge.data.datasets[0].value = data.arusAir || 0;
                    window.myGauge.update();

                    fm.setPercentage(data.ping || 0);
                } catch (error) {
                    console.error("Error parsing SSE response:", error);
                }
            }, 3000);

            eventSource.onmessage = throttledUpdate;

            eventSource.onerror = (error) => {
                console.error("SSE error:", error);
                eventSource.close(); // Close the connection
                setTimeout(() => {
                    eventSource = new EventSource("{{ route('api.get.sse') }}");
                    retryTimeout = Math.min(retryTimeout * 2,
                        10000);
                }, retryTimeout);
            };

            eventSource.onopen = () => {
                console.log("SSE connection established.");
                retryTimeout = 5000;
            };

            window.addEventListener("beforeunload", () => {
                eventSource.close();
                console.log("SSE connection closed.");
            });
        });
    </script>
@endsection
