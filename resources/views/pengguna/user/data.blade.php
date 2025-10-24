@extends('layouts.app')

@section('title', 'User Management')
@section('page-heading', 'User Management')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Mahasiswa</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
                        Add Mahasiswa
                    </button>
                </div>
                <div class="card-body">
                    <div class="rounded-4 p-3 mb-4">
                        <form method="GET" action="{{ route('user') }}" class="row g-3">
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
                                    <th>Foto</th>
                                    <th>Name</th>
                                    <th>NPM</th>
                                    <th>Fakultas</th>
                                    <th>Prodi</th>
                                    <th>Angkatan</th>
                                    <th>Nomor Telpon</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            @if ($user->profile_photo)
                                                <img src="{{ asset('storage/' . $user->profile_photo) }}"
                                                    alt="Profile Photo"
                                                    class="rounded-circle border border-3 border-primary"
                                                    style="width: 64px; height: 64px; object-fit: cover;" />
                                            @else
                                                <span>No Photo</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->npm }}</td>
                                        <td>{{ $user->fakultas_detail?->name }}</td>
                                        <td>{{ $user->prodi_detail?->name }}</td>
                                        <td>{{ $user->angkatan }}</td>
                                        <td>{{ $user->nomor_telpon }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-warning edit-btn"
                                                data-id="{{ $user->id }}">Edit</button>
                                            <button class="btn btn-sm btn-danger delete-btn"
                                                data-id="{{ $user->id }}">Delete</button>
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
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="npm" class="form-label">NPM</label>
                            <input type="text" class="form-control" id="npm" name="npm" required>
                        </div>
                        <div class="mb-3">
                            <label for="fakultas" class="form-label">Fakultas</label>
                            <select id="fakultas" name="fakultas" class="form-control" required>
                                <option value="">-- Pilih Fakultas --</option>
                                @foreach ($fakultas as $fk)
                                    <option value="{{ $fk->id }}">{{ $fk->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="prodi" class="form-label">Prodi</label>
                            <select id="prodi" name="prodi" class="form-control" required disabled>
                                <option value="">-- Pilih Prodi --</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="angkatan" class="form-label">Angkatan</label>
                            <input type="number" class="form-control" id="angkatan" name="angkatan" min="1900"
                                max="{{ date('Y') + 10 }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="nomor_telpon" class="form-label">Nomor Telpon</label>
                            <input type="text" class="form-control" id="nomor_telpon" name="nomor_telpon" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" required>
                        </div>
                        <div class="mb-3">
                            <label for="profile_photo" class="form-label">Profile Photo</label>
                            <input type="file" class="form-control" id="profile_photo" name="profile_photo"
                                accept="image/*">
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
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editUserForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="editUserId" name="id">
                        <div class="mb-3">
                            <label for="editName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editNpm" class="form-label">NPM</label>
                            <input type="text" class="form-control" id="editNpm" name="npm" required>
                        </div>
                        <div class="mb-3">
                            <label for="editFakultas" class="form-label">Fakultas</label>
                            <select id="editFakultas" name="fakultas" class="form-control" required>
                                <option value="">-- Pilih Fakultas --</option>
                                @foreach ($fakultas as $fk)
                                    <option value="{{ $fk->id }}">{{ $fk->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editProdiId" class="form-label">Prodi</label>
                            <select id="editProdiId" name="prodi" class="form-control" required disabled>
                                <option value="">-- Pilih Prodi --</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editAngkatan" class="form-label">Angkatan</label>
                            <input type="number" class="form-control" id="editAngkatan" name="angkatan" min="1900"
                                max="{{ date('Y') + 10 }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="editNomorTelpon" class="form-label">Nomor Telpon</label>
                            <input type="text" class="form-control" id="editNomorTelpon" name="nomor_telpon"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="editPassword" class="form-label">Password (leave blank to keep current)</label>
                            <input type="password" class="form-control" id="editPassword" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="editPasswordConfirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="editPasswordConfirmation"
                                name="password_confirmation">
                        </div>
                        <div class="mb-3">
                            <label for="editProfilePhoto" class="form-label">Profile Photo</label>
                            <input type="file" class="form-control" id="editProfilePhoto" name="profile_photo"
                                accept="image/*">
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
                    url: '{{ route('user.store') }}',
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


            $('#editFakultas').on('change', function() {
                loadProdiOptions($(this).val(), $('#editProdiId'));
            });

            $(document).on('click', '.edit-btn', function(e) {
                e.preventDefault();

                const userId = $(this).data('id');

                // Tampilkan modal via Bootstrap 5 API (lebih stabil daripada $('#...').modal('show'))
                const modalEl = document.getElementById('editUserModal');
                const editUserModal = new bootstrap.Modal(modalEl);
                editUserModal.show();

                $.get("{{ url('users') }}/" + userId, function(u) {
                    $('#editUserId').val(u.id);
                    $('#editName').val(u.name);
                    $('#editNpm').val(u.npm);
                    $('#editAngkatan').val(u.angkatan);
                    $('#editNomorTelpon').val(u.nomor_telpon);
                    $('#editEmail').val(u.email);
                    $('#editPassword').val('');
                    $('#editPasswordConfirmation').val('');
                    $('#editFakultas').val(u.fakultas);
                    loadProdiOptions(u.fakultas, $('#editProdiId'), u.prodi);
                }).fail(function() {
                    editUserModal.hide();
                    Swal.fire('Error!', 'Failed to load user data.', 'error');
                });
            });

            $(document).on('submit', '#editUserForm', function(e) {
                e.preventDefault();

                var userId = $('#editUserId').val();
                var formData = new FormData(this);

                if ($('#editPassword').val() === '') {
                    formData.delete('password');
                    formData.delete('password_confirmation');
                }

                formData.append('_method', 'PUT');
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: '{{ url('users') }}/' + userId,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function() {
                        const modalEl = document.getElementById('editUserModal');
                        bootstrap.Modal.getInstance(modalEl)?.hide();
                        Swal.fire({
                            title: 'Success!',
                            text: 'User updated successfully.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => location.reload());
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
                    title: 'Hapus User?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ url('users') }}/' + userId,
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
