@if (Auth::user()->role == 'user')
    {{-- <li class="sidebar-item {{ Route::currentRouteName() == 'related-records.create' ? 'active' : '' }}">
        <a href="{{ route('related-records.create') }}" class='sidebar-link'>
            <i class="bi bi-cloud-arrow-up-fill"></i>
            <span>File Uploader</span>
        </a>
    </li> --}}
    <li class="sidebar-item {{ Route::is('user-aktifitas-mahasiswa.*') ? 'active' : '' }}">
        <a href="{{ route('user-aktifitas-mahasiswa.index') }}" class="sidebar-link">
            <i class="bi bi-cloud-arrow-up-fill"></i>
            <span>Aktifitas Mahasiswa</span>
        </a>
    </li>
    <li class="sidebar-item {{ Route::is('user-magang.*') ? 'active' : '' }}">
        <a href="{{ route('user-magang.index') }}" class="sidebar-link">
            <i class="bi bi-cloud-arrow-up-fill"></i>
            <span>Sertifikat Magang</span>
        </a>
    </li>
    <li class="sidebar-item {{ Route::is('user-detail.*') ? 'active' : '' }}">
        <a href="{{ route('user-detail.index') }}" class="sidebar-link">
            <i class="bi bi-file-arrow-up-fill"></i>
            <span>Cetak</span>
        </a>
    </li>
    {{-- <li class="sidebar-item {{ Route::currentRouteName() == 'cetak' ? 'active' : '' }}">
        <a href="{{ route('cetak') }}" class='sidebar-link'>
            <i class="bi bi-map-fill"></i>
            <span>Cetak</span>
        </a>
    </li> --}}
@endif
