    <!-- Navbar -->
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#menu-toggle" id="menu-toggle">
                <span class="btn btn-default">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </span>
            </a>
        </div>
    </nav>

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <a href="https://www.ukdw.ac.id/akademik/fakultas-bioteknologi/">
                    <img src="{{ asset('main/img/LOGO-FAK-BIOTEK.png') }}" class="logo img-fluid" alt="LOGO-BIOTEK.png">
                </a>
            </li>
            <hr class="my-2 border border-light border-1 opacity-100">
            <li>
                <a href="{{ route('main.dashboard') }}" class="{{ request()->routeIs('main.dashboard') ? 'active' : '' }}">
                    Dashboard <i class="bi bi-speedometer2 float-end me-4"></i>
                </a>
            </li>
            <hr class="mt-2 mb-0 border border-light border-1 opacity-100">
            <li>
                <h5 class="fs-5 text-light fw-bold mt-2 d-flex align-items-center justify-content-between"
                    id="tabelDataToggle" style="cursor: pointer;">
                    Tabel Data
                    <i class="bi bi-caret-down-fill me-4" id="tabelCaret"></i>
                </h5>
                <ul class="list-unstyled ms-4 collapse" id="tabelDataList">
                    <li>
                        <a href="{{ route('main.tabelTDS') }}"
                            class="{{ request()->routeIs('main.tabelTDS') ? 'active' : '' }}">
                            Tabel TDS <i class="bi bi-table float-end me-4"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('main.tabelUdara') }}"
                            class="{{ request()->routeIs('main.tabelUdara') ? 'active' : '' }}">
                            Tabel Udara <i class="bi bi-table float-end me-4"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('main.tabelArus') }}"
                            class="{{ request()->routeIs('main.tabelArus') ? 'active' : '' }}">
                            Tabel Arus Air <i class="bi bi-table float-end me-4"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <h5 class="fs-5 text-light fw-bold mt-2 d-flex align-items-center justify-content-between"
                    id="accountToggle" style="cursor: pointer;">
                    Akun
                    <i class="bi bi-caret-down-fill me-4" id="accountCaret"></i>
                </h5>
                <ul class="list-unstyled ms-4 d-none" id="accountList">
                    <li>
                        <a href=""
                           class="">
                            Pengaturan Akun <i class="bi bi-gear-fill float-end me-4"></i>
                        </a>
                    </li>
                    <li>
                        <a href=""
                           class="">
                            Tambah Akun Baru <i class="bi bi-person-plus-fill float-end me-4"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <hr class="mt-2 mb-0 border border-light border-1 opacity-100">
        </ul>
    </div>
    <!-- /#sidebar-wrapper -->
