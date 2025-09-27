<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('build/assets/images/logo/ibatek.png') }}" alt="Logo" style="width: 150px; height:50px;">
                    </a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>
                <li class="sidebar-item {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-title">Admin &amp; Data</li>
                <li class="sidebar-item {{ Route::currentRouteName() == 'verifikasi' ? 'active' : '' }}">
                    <a href="{{ route('verifikasi') }}" class='sidebar-link'>
                        <i class="bi bi-check2-square"></i>
                        <span>Verifikasi</span>
                    </a>
                </li>
                @php
                $isAkademikActive = str_starts_with(Route::currentRouteName(), 'fakultas') ||
                str_starts_with(Route::currentRouteName(), 'prodi') ||
                str_starts_with(Route::currentRouteName(), 'tipe');
                @endphp
                <li class="sidebar-item has-sub {{ $isAkademikActive ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-pen-fill"></i>
                        <span>Akademik</span>
                    </a>
                    <ul class="submenu {{ $isAkademikActive ? 'active' : '' }}">
                        <li class="submenu-item {{ str_starts_with(Route::currentRouteName(), 'fakultas') ? 'active' : '' }}">
                            <a href="{{ route('fakultas') }}">Fakultas</a>
                        </li>
                        <li class="submenu-item {{ str_starts_with(Route::currentRouteName(), 'prodi') ? 'active' : '' }}">
                            <a href="{{ route('prodi') }}">Prodi</a>
                        </li>
                        <li class="submenu-item {{ str_starts_with(Route::currentRouteName(), 'tipe') ? 'active' : '' }}">
                            <a href="{{ route('tipe.index') }}">Tipe Aktifitas Mahasiswa</a>
                        </li>
                    </ul>
                </li>

                @php
                $isKegiatanActive = str_starts_with(Route::currentRouteName(), 'organisasi') ||
                str_starts_with(Route::currentRouteName(), 'kepanitiaan') ||
                str_starts_with(Route::currentRouteName(), 'magang') ||
                str_starts_with(Route::currentRouteName(), 'tridharma') ||
                str_starts_with(Route::currentRouteName(), 'lomba') ||
                str_starts_with(Route::currentRouteName(), 'ukm');
                @endphp
                <li class="sidebar-item has-sub {{ $isKegiatanActive ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-hexagon-fill"></i>
                        <span>Kegiatan</span>
                    </a>
                    <ul class="submenu {{ $isKegiatanActive ? 'active' : '' }}">
                        <li class="submenu-item {{ str_starts_with(Route::currentRouteName(), 'organisasi') ? 'active' : '' }}">
                            <a href="{{ route('organisasi') }}">Organisasi</a>
                        </li>
                        <li class="submenu-item {{ str_starts_with(Route::currentRouteName(), 'kepanitiaan') ? 'active' : '' }}">
                            <a href="{{ route('kepanitiaan') }}">Kepanitiaan</a>
                        </li>
                        <li class="submenu-item {{ str_starts_with(Route::currentRouteName(), 'magang') ? 'active' : '' }}">
                            <a href="{{ route('magang') }}">Magang</a>
                        </li>
                        <li class="submenu-item {{ str_starts_with(Route::currentRouteName(), 'tridharma') ? 'active' : '' }}">
                            <a href="{{ route('tridharma') }}">Tridharma</a>
                        </li>
                        <li class="submenu-item {{ str_starts_with(Route::currentRouteName(), 'lomba') ? 'active' : '' }}">
                            <a href="{{ route('lomba') }}">Lomba</a>
                        </li>
                        <li class="submenu-item {{ str_starts_with(Route::currentRouteName(), 'ukm') ? 'active' : '' }}">
                            <a href="{{ route('ukm.index') }}">UKM</a>
                        </li>
                    </ul>
                </li>
               @if(Auth::user()->role == 'admin')
                @php
                $isAkunActive = str_starts_with(Route::currentRouteName(), 'user') ||
                str_starts_with(Route::currentRouteName(), 'admin');
                @endphp
                <li class="sidebar-item has-sub {{ $isAkunActive ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-person-badge-fill"></i>
                        <span>Akun</span>
                    </a>
                    <ul class="submenu {{ $isAkunActive ? 'active' : '' }}">
                        <li class="submenu-item {{ str_starts_with(Route::currentRouteName(), 'user') ? 'active' : '' }}">
                            <a href="{{ route('user') }}">User</a>
                        </li>
                        <li class="submenu-item {{ str_starts_with(Route::currentRouteName(), 'admin') ? 'active' : '' }}">
                            <a href="{{ route('admin') }}">Admin</a>
                        </li>
                    </ul>
                </li>
                @endif


                <li class="sidebar-item {{ Route::currentRouteName() == 'related-records.create' ? 'active' : '' }}">
                    <a href="{{ route('related-records.create') }}" class='sidebar-link'>
                        <i class="bi bi-cloud-arrow-up-fill"></i>
                        <span>File Uploader</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Route::currentRouteName() == 'cetak' ? 'active' : '' }}">
                    <a href="{{ route('cetak') }}" class='sidebar-link'>
                        <i class="bi bi-map-fill"></i>
                        <span>Cetak</span>
                    </a>

                </li>


                <li class="sidebar-title">Pages</li>

                <li class="sidebar-item {{ Route::currentRouteName() == 'profile.edit' ? 'active' : '' }}">
                    <a href="{{ route('profile.edit') }}" class='sidebar-link'>
                        <i class="bi bi-person-fill"></i>
                        <span>Profile</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <a href="#" class="sidebar-link"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Logout</span>
                        </a>
                    </form>
                </li>


            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>