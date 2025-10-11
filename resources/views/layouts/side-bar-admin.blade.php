  @if (Auth::user()->role == 'admin')
      <li class="sidebar-title">Admin &amp; Data</li>
      <li class="sidebar-item {{ Route::currentRouteName() == 'verifikasi' ? 'active' : '' }}">
          <a href="{{ route('verifikasi') }}" class='sidebar-link'>
              <i class="bi bi-check2-square"></i>
              <span>Verifikasi</span>
          </a>
      </li>
      @php
          $isAkademikActive =
              str_starts_with(Route::currentRouteName(), 'fakultas') ||
              str_starts_with(Route::currentRouteName(), 'prodi') ||
              str_starts_with(Route::currentRouteName(), 'organisasi') ||
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
              <li class="submenu-item {{ str_starts_with(Route::currentRouteName(), 'organiasi') ? 'active' : '' }}">
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
