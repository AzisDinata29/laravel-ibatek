@extends('layouts.app')

@section('title', 'Magang Management')
@section('page-heading', 'Magang Management')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Magang</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
                        Add Magang
                    </button>
                </div>
                <div class="card-body">
                    <div class="rounded-4 p-3 mb-4">
                        <form method="GET" action="{{ route('magang.index') }}" class="row g-3">
                            <div class="col-12 col-md-4">
                                <label class="form-label mb-1">Fakultas</label>
                                <select name="fakultas_id" id="filterFakultas"
                                    class="form-select form-select-sm rounded-pill" required>
                                    <option value="" selected disabled>-- Pilih Fakultas --</option>
                                    @foreach ($fakultas ?? [] as $f)
                                        <option value="{{ $f->id }}"
                                            {{ request('fakultas_id') == $f->id ? 'selected' : '' }}>
                                            {{ $f->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label mb-1">Program Studi</label>
                                <select name="prodi_id" id="filterProdi" class="form-select form-select-sm rounded-pill"
                                    required>
                                    <option value="" selected disabled>-- Pilih Prodi --</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label mb-1">Angkatan</label>
                                <select name="angkatan" id="filterAngkatan" class="form-select form-select-sm rounded-pill"
                                    required>
                                    <option value="" selected disabled>-- Pilih Angkatan --</option>
                                    @foreach ($angkatanList ?? [] as $angk)
                                        <option value="{{ $angk }}"
                                            {{ request('angkatan') == $angk ? 'selected' : '' }}>
                                            {{ $angk }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-1 d-flex align-items-end gap-2">
                                <button type="submit" class="btn btn-primary w-100 btn-sm rounded-pill">Filter</button>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTables" class="table table-striped table-hover align-middle nowrap"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>NPM</th>
                                    <th>Fakultas</th>
                                    <th>Prodi</th>
                                    <th>Angkatan</th>
                                    {{-- <th>No Magang</th> --}}
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->npm }}</td>
                                        <td>{{ $user->fakultas_detail?->name }}</td>
                                        <td>{{ $user->prodi_detail?->name }}</td>
                                        <td>{{ $user->angkatan }}</td>
                                        {{-- <td>{{ $user->magang_detail->no_magang }}</td> --}}
                                        <td>
                                            <a href="{{ route('magang.edit', $user->magang_detail->id) }}"
                                                class="btn btn-sm btn-info">Cetak</a>
                                            {{-- <button class="btn btn-sm btn-warning edit-btn"
                                                data-id="{{ $user->magang_detail->id }}">Edit</button> --}}
                                            <button class="btn btn-sm btn-danger delete-btn"
                                                data-id="{{ $user->magang_detail->id }}">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createUserForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{-- <div class="mb-3">
                            <label for="no_magang" class="form-label">No Magang</label>
                            <input type="text" class="form-control" id="no_magang" name="no_magang" required>
                        </div> --}}
                        <div class="mb-3">
                            <label for="mahasiswa" class="form-label">Mahasiswa</label>
                            <select name="user_id" class="form-select form-select-sm rounded-pill" required>
                                <option value="" selected disabled>-- Pilih Nama Mahasiswa --</option>
                                @foreach ($mahasiswa ?? [] as $row)
                                    <option value="{{ $row->id }}">
                                        {{ $row->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit Magang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editUserForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="editUserId" name="id">
                        <div class="mb-3">
                            <label for="editName" class="form-label">No Magang</label>
                            <input type="text" class="form-control" id="editName" name="no_magang" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            function loadProdiOptions(fakultasId, $targetSelect, selectedId = null) {
                $targetSelect.prop('disabled', true).html('<option value="">Memuat...</option>');
                if (!fakultasId) {
                    $targetSelect.html('<option value="">-- Pilih Prodi --</option>');
                    return;
                }
                $.get("{{ route('prodi.byFakultas', ['id' => 'FAK']) }}".replace('FAK', fakultasId), function(
                    items) {
                    let opts = '<option value="">-- Pilih Prodi --</option>';
                    items.forEach(it => {
                        const sel = (selectedId && Number(selectedId) === Number(it.id)) ?
                            'selected' : '';
                        opts += `<option value="${it.id}" ${sel}>${it.name}</option>`;
                    });
                    $targetSelect.html(opts).prop('disabled', false);
                });
            }
            $('#createUserForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: '{{ route('magang.store') }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#createUserModal').modal('hide');
                        $('#createUserForm')[0].reset();
                        Swal.fire({
                            title: 'Success!',
                            text: 'User created successfully.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON?.errors;
                        var errorMessage = 'An error occurred.';
                        if (errors) {
                            errorMessage = Object.values(errors).flat().join('\n');
                        }
                        Swal.fire('Error!', errorMessage, 'error');
                    }
                });
            });
            $('#fakultas').on('change', function() {
                loadProdiOptions($(this).val(), $('#prodi'));
            });
            $('.edit-btn').on('click', function() {
                const userId = $(this).data('id');
                $('#editUserModal').modal('show');

                $.get("{{ url('magang') }}/" + userId, function(u) {
                    $('#editUserId').val(u.id);
                    $('#editName').val(u.no_magang);
                }).fail(function() {
                    $('#editUserModal').modal('hide');
                    Swal.fire('Error!', 'Failed to load user data.', 'error');
                });
            });

            $('#editFakultas').on('change', function() {
                loadProdiOptions($(this).val(), $('#editProdiId'));
            });

            $('#editUserForm').on('submit', function(e) {
                e.preventDefault();
                var userId = $('#editUserId').val();
                var formData = new FormData(this);
                formData.append('_method', 'PUT');
                formData.append('_token', '{{ csrf_token() }}');
                $.ajax({
                    url: '{{ url('magang') }}/' + userId,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#editUserModal').modal('hide');
                        Swal.fire({
                            title: 'Success!',
                            text: 'User updated successfully.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON?.errors;
                        let errorMessage = 'An error occurred.';
                        if (errors) {
                            errorMessage = Object.values(errors).flat().join('\n');
                        }
                        Swal.fire('Error!', errorMessage, 'error');
                    }
                });
            });

            $('.delete-btn').on('click', function() {
                var userId = $(this).data('id');
                Swal.fire({
                    title: 'Hapus Data Magang?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ url('magang') }}/' + userId,
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Terhapus!',
                                    text: 'User berhasil dihapus.',
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: 'Terjadi kesalahan saat menghapus user.',
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fakultasSelect = document.getElementById('filterFakultas');
            const prodiSelect = document.getElementById('filterProdi');
            const selectedProdi = "{{ request('prodi_id') ?? '' }}";

            fakultasSelect.addEventListener('change', function() {
                const fakultasId = this.value;
                prodiSelect.innerHTML = '<option value="">Pilih Prodi</option>';

                if (fakultasId) {
                    fetch(`/prodi/by-fakultas/${fakultasId}`)
                        .then(res => res.json())
                        .then(data => {
                            data.forEach(prodi => {
                                const opt = document.createElement('option');
                                opt.value = prodi.id;
                                opt.textContent = prodi.name;
                                if (selectedProdi == prodi.id) opt.selected = true;
                                prodiSelect.appendChild(opt);
                            });
                        });
                }
            });

            // trigger otomatis saat load pertama kali
            if (fakultasSelect.value) fakultasSelect.dispatchEvent(new Event('change'));
        });
    </script>
    <script>
        $('#dataTables').DataTable({
            responsive: true
        });
    </script>
@endpush
