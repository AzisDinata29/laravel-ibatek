  @if (Auth::user()->role == 'admin')
      <li class="sidebar-title">Admin &amp; Data</li>
      @php
          $isDataMaster =
              str_starts_with(Route::currentRouteName(), 'fakultas') ||
              str_starts_with(Route::currentRouteName(), 'prodi') ||
              str_starts_with(Route::currentRouteName(), 'organisasi') ||
              str_starts_with(Route::currentRouteName(), 'tipe');
      @endphp
      <li class="sidebar-item has-sub {{ $isDataMaster ? 'active' : '' }}">
          <a href="#" class='sidebar-link'>
              <i class="bi bi-pen-fill"></i>
              <span>Data Master</span>
          </a>
          <ul class="submenu {{ $isDataMaster ? 'active' : '' }}">
              <li class="submenu-item {{ str_starts_with(Route::currentRouteName(), 'fakultas') ? 'active' : '' }}">
                  <a href="{{ route('fakultas') }}">Fakultas</a>
              </li>
              <li class="submenu-item {{ str_starts_with(Route::currentRouteName(), 'prodi') ? 'active' : '' }}">
                  <a href="{{ route('prodi') }}">Prodi</a>
              </li>
              {{-- <li class="submenu-item {{ str_starts_with(Route::currentRouteName(), 'tipe') ? 'active' : '' }}">
                  <a href="{{ route('tipe.index') }}">Tipe Aktifitas Mahasiswa</a>
              </li> --}}
              <li class="submenu-item {{ Route::is('organisasi*') ? 'active' : '' }}">
                  <a href="{{ route('organisasi') }}">Organisasi</a>
              </li>
          </ul>
      </li>
      @php
          $isAkunActive =
              str_starts_with(Route::currentRouteName(), 'user') || str_starts_with(Route::currentRouteName(), 'admin');
      @endphp
      <li class="sidebar-item has-sub {{ $isAkunActive ? 'active' : '' }}">
          <a href="#" class='sidebar-link'>
              <i class="bi bi-person-badge-fill"></i>
              <span>Data Pengguna</span>
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
      <li class="sidebar-item {{ Route::is('verifikasi-aktifitas-mahasiswa.*') ? 'active' : '' }}">
          <a href="{{ route('verifikasi-aktifitas-mahasiswa.index') }}" class='sidebar-link'>
              <i class="bi bi-check2-square"></i>
              <span>Verifikasi</span>
          </a>
      </li>
      <li class="sidebar-item {{ Route::is('aktifitas-mahasiswa.*') ? 'active' : '' }}">
          <a href="{{ route('aktifitas-mahasiswa.index') }}" class="sidebar-link">
              <i class="bi bi-cloud-arrow-up-fill"></i>
              <span>Aktifitas Mahasiswa</span>
          </a>
      </li>
      <li class="sidebar-item {{ Route::is('magang.*') ? 'active' : '' }}">
          <a href="{{ route('magang.index') }}" class="sidebar-link">
              <i class="bi bi-cloud-arrow-up-fill"></i>
              <span>Data Magang</span>
          </a>
      </li>
      <li class="sidebar-item {{ Route::is('laporan.*') ? 'active' : '' }}">
          <a href="{{ route('laporan.index') }}" class="sidebar-link">
              <i class="bi bi-file-arrow-up-fill"></i>
              <span>Laporan</span>
          </a>
      </li>
  @endif
