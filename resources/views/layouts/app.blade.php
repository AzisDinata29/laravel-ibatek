<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ibatek || Sistem Kendali Mahasiswa Beasiswa')</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('build/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('build/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('build/assets/images/logo/ibtk.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">
    @stack('styles')
</head>

<body>
    <div id="app">
        @include('layouts.sidebar')
        <div id="main">
            @include('layouts.header')
            <div class="page-heading">
                <h3>@yield('page-heading', 'Profile Statistics')</h3>
            </div>
            <div class="page-content">
                @yield('content')
            </div>
            @include('layouts.footer')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('build/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/main.js') }}"></script>
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
