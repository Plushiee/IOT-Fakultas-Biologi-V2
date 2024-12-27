<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="IOT - Fakultas Biologi">
    <meta name="author" content="Anthonius Adi Nugroho, S.T., M.Cs., Nikolaus Pastika Bara Satyaradi">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://getbootstrap.com/docs/5.3/assets/js/color-modes.js"></script>

    <link rel="stylesheet" href="{{ asset('main/css/navbar.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @yield('css-extras')
    <style>
        /* Floating Container */
        .floating-container {
            position: fixed;
            bottom: 20px;
            right: 0px;
            display: flex;
            align-items: center;
            transition: transform 0.3s ease;
        }

        /* Floating Button Styling */
        .floating-btn {
            background-color: #077f0d;
            color: #fff;
            border: none;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .floating-btn:hover {
            background-color: #045b08;
        }

        .floating-btn.hidden {
            transform: translateX(80px);
            opacity: 0;
        }

        .floating-container.hidden {
            transform: translateX(60px);
            transition: transform 0.3s ease;
        }

        /* Toggle Button Styling */
        .toggle-btn {
            background-color: #077f0d;
            color: #fff;
            border: none;
            border-top-left-radius: 15%;
            border-bottom-left-radius: 15%;
            width: 40px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .toggle-btn:hover {
            background-color: #045b08;
        }
    </style>
</head>

<body>
    {{-- @vite('resources/js/app.js') --}}
    <div id="wrapper">
        <!-- navbar -->
        @include('umum.templates.navbar')
        <!-- /#navbar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        @yield('content')

                        <!-- Floating Button Login -->
                        <div class="floating-container hidden">
                            <button class="toggle-btn" id="toggle-btn">
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <button class="floating-btn" id="btn-login">
                                🔑
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->


    <!-- Core JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- /Core JavaScript -->

    <!-- Script Extras -->
    <script src="{{ asset('main/js/sidebar.js') }}"></script>
    <script src="{{ asset('main/js/notification.js') }}"></script>
    @yield('jQuery-extras')

    <!-- Script Untuk Dashboard -->
    <script>
        $(document).ready(function() {
            // Dropdown Tabel Data
            $('#tabelDataToggle').click(function() {
                const caretTabel = $('#tabelCaret');
                const listTabbel = $('#tabelDataList');

                listTabbel.slideToggle(400); // Slide toggle animation
                caretTabel.toggleClass('bi-caret-down-fill bi-caret-up-fill');
            });

            // Dropdown Pengaturan Akun
            $('#akunToggle').click(function() {
                const caretAkun = $('#akunCaret');
                const listAkun = $('#akunList');

                listAkun.slideToggle(400); // Slide up and down animation
                caretAkun.toggleClass('bi-caret-down-fill bi-caret-up-fill');
            });


            const $btnLogin = $('#btn-login');
            const $toggleBtn = $('#toggle-btn');
            const $floatingContainer = $('.floating-container');
            let isHidden = true;

            // Mulai dalam keadaan tersembunyi
            $btnLogin.addClass('hidden');

            $toggleBtn.on('click', function() {
                isHidden = !isHidden;
                if (isHidden) {
                    $btnLogin.addClass('hidden');
                    $floatingContainer.addClass('hidden');
                    $toggleBtn.html('<i class="bi bi-chevron-left"></i>');
                } else {
                    $btnLogin.removeClass('hidden');
                    $floatingContainer.removeClass('hidden');
                    $toggleBtn.html(
                        '<i class="bi bi-chevron-right"></i>');
                }
            });

            // Login
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
    <!-- /Script Untuk Dashboard -->

    <!-- /Script Extras -->
</body>

</html>
