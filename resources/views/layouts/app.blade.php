<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ibatek || Sistem Kendali Mahasiswa Beasiswa')</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets-new/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-new/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('assets-new/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-new/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-new/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets-new/images/logo/ibtk.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">
    @stack('styles')
</head>

<body>
    <div id="app">
        @include('layouts.sidebar')
        <div id="main">
            @include('layouts.header')
            <div class="page-heading d-flex justify-content-between align-items-center">
                <div class="text-end">
                    <h3 class="mb-0">@yield('page-heading', 'Profile Statistics')</h3>
                </div>
                <a href="{{ route('profile.edit') }}" class="d-flex align-items-center gap-3 ">
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo ?? 'default.png') }}" alt="User Photo"
                        class="rounded-circle" width="48" height="48">
                    <div class="user-info bg-white rounded p-2">
                        <h5 class="mb-0 fw-semibold">{{ Auth::user()->name ?? 'Nama Pengguna' }}</h5>
                        <small class="text-muted">{{ Auth::user()->email ?? 'user@example.com' }}</small>
                    </div>
                </a>
            </div>
            <div class="page-content">
                @yield('content')
            </div>
            @include('layouts.footer')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets-new/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets-new/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets-new/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>
    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    Swal.fire({
                        title: 'Apakah Anda yakin untuk menghapus?',
                        text: "Data ini tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#ffa700',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                });
            });
        });
    </script>
    <script>
        // $('#usersTable').DataTable({
        //     responsive: true
        // });
    </script>

</body>

</html>
