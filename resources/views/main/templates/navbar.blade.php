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
        <li>
            <a href="{{ route('main.tabelTDS') }}" class="{{ request()->routeIs('main.tabelTDS') ? 'active' : '' }}">
                Tabel TDS <i class="bi bi-table float-end me-4"></i>
            </a>
        </li>
        <li>
            <a href="{{ route('main.tabelPH') }}" class="{{ request()->routeIs('main.tabelPH') ? 'active' : '' }}">
                Tabel PH <i class="bi bi-table float-end me-4"></i>
            </a>
        </li>
        <li>
            <a href="{{ route('main.tabelUdara') }}"
                class="{{ request()->routeIs('main.tabelUdara') ? 'active' : '' }}">Tabel Udara<i
                    class="bi bi-table float-end me-4"></i></a>
        </li>
        <li>
            <a href="{{ route('main.tabelArus') }}" class="{{ request()->routeIs('main.tabelArus') ? 'active' : '' }}">Tabel Arus Air <i
                    class="bi bi-table float-end me-4"></i></a>
        </li>
    </ul>
</div>
<!-- /#sidebar-wrapper -->
