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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://getbootstrap.com/docs/5.3/assets/js/color-modes.js"></script>

    <link rel="stylesheet" href="{{ asset('main/css/navbar.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @yield('css-extras')
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
        });
    </script>
    <!-- /Script Untuk Dashboard -->

    <!-- /Script Extras -->
</body>

</html>
