@extends('layouts.app')

@section('title', 'Kelola Catatan')
@section('page-heading', 'Kelola Catatan')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Kelola Catatan Terkait</h6>
            <a href="{{ route('related-records.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Create
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Report Filters -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="m-0 font-weight-bold text-primary mb-3">
                                        Filter Laporan
                                    </div>
                                    <form class="form-label text-warning">
                                        <div class="form-label text-warning">
                                            <label for="verifiedStatus" class="sr-only">Status Verifikasi</label>
                                            <select class="form-control form-control-sm" id="verifiedStatus">
                                                <option value="">Semua</option>
                                                <option value="verified" selected>Sudah Verifikasi</option>
                                                <option value="not_verified">Belum Verifikasi</option>
                                            </select>
                                        </div>
                                        <div class="form-label text-warning">
                                            <label for="recordType" class="sr-only">Jenis Catatan</label>
                                            <select class="form-control form-control-sm" id="recordType">
                                                <option value="">Semua</option>
                                                <option value="organization">Organisasi</option>
                                                <option value="kepaniitiaan">Kepanitiaan</option>
                                                <option value="magang">Magang</option>
                                                <option value="tridharma">Tridharma</option>
                                                <option value="lomba">Lomba</option>
                                                <option value="ukm">UKM</option>
                                            </select>
                                        </div>
                                        <div class="form-label text-warning">
                                            <label for="semesterFilter" class="sr-only">Semester</label>
                                            <select class="form-control form-control-sm" id="semesterFilter">
                                                <option value="">Semua</option>
                                                <option value="1">Semester 1</option>
                                                <option value="2">Semester 2</option>
                                                <option value="3">Semester 3</option>
                                                <option value="4">Semester 4</option>
                                                <option value="5">Semester 5</option>
                                                <option value="6">Semester 6</option>
                                                <option value="7">Semester 7</option>
                                                <option value="8">Semester 8</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-sm mb-1" style="color: rgb(255, 255, 255); background-color: rgb(255, 174, 0); border-color: rgb(255, 174, 0);">
                                            <i class="fas fa-filter"></i> Terapkan
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Records Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="recordsTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Pengguna</th>
                            <th>Tipe Catatan</th>
                            <th>Detail</th>
                            <th>Waktu</th>
                            <th>Semester</th>
                            <th>Verification</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($relatedRecords as $record)
                        <tr>
                            <td>{{ $record->id }}</td>
                            <td>{{ $record->user->name ?? '-' }}</td>
                            <td>
                                @if($record->organization_id)
                                    Organization
                                @elseif($record->kepaniitiaan_id)
                                    Kepanitiaan
                                @elseif($record->magang_id)
                                    Magang
                                @elseif($record->tridharma_id)
                                    Tridharma
                                @elseif($record->lomba_id)
                                    Lomba
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($record->organization_id)
                                    {{ $record->organization->name ?? '-' }}
                                @elseif($record->kepaniitiaan_id)
                                    {{ $record->kepaniitiaan->name ?? '-' }}
                                @elseif($record->magang_id)
                                    {{ $record->magang->company_name ?? '-' }}
                                @elseif($record->tridharma_id)
                                    {{ $record->tridharma->title ?? '-' }}
                                @elseif($record->lomba_id)
                                    {{ $record->lomba->title ?? '-' }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($record->durasi)
                                    {{ $record->durasi }} Menit
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $record->semester ?? '-' }}</td>
                            <td>
                                <span class="badge {{ $record->is_verified ? 'badge-success' : 'badge-warning' }}">
                                    {{ $record->is_verified ? 'Verified' : 'Pending' }}
                                </span>
                                {{-- @if($record->verified_by)
                                    <br><small>By: {{ $record->verifiedBy->name ?? '-' }}</small>
                                @endif --}}
                            </td>
                            <td>
                                <div class="d-flex gap-1"> {{-- flexbox dengan jarak antar tombol --}}
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('related-records.edit', $record->id) }}" 
                                    class="btn btn-sm btn-outline-primary">
                                        Edit
                                    </a>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('related-records.destroy', $record->id) }}" 
                                        method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            Hapus
                                        </button>
                                    </form>

                                    {{-- Tombol Verify (hanya muncul kalau belum diverifikasi) --}}
                                    @if(!$record->is_verified)
                                        <form action="{{ route('related-records.verify', $record->id) }}" 
                                            method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success">
                                                Verify
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Tombol View --}}
                                    <button type="button" class="btn btn-sm btn-outline-info view-details" 
                                            data-record-id="{{ $record->id }}">
                                        View
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Record Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="recordDetails">
                <!-- Details will be loaded here via JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
    .card-header {
    background: linear-gradient(90deg, #ffffff, #ffc400);
    color: #fff !important;
    border: none;
    border-radius: 0.5rem 0.5rem 0 0;
    padding: 1rem 1.5rem;
}

.card-header h6 {
    font-weight: 600;
    font-size: 1rem;
}

.btn {
    border-radius: 30px;
    font-weight: 500;
    transition: all 0.2s ease-in-out;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

#filterCard {
    border: none;
    border-radius: 0.75rem;
    background: #f8f9fc;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    padding: 1.5rem;
}

#filterCard .form-control {
    border-radius: 0.5rem;
    border: 1px solid #d1d3e2;
    font-size: 0.9rem;
}

.table {
    border-radius: 0.75rem;
    overflow: hidden;
}

#recordsTable {
  text-align: center;
}

.table thead {
    background: #ffc400;
    color: #fff;
    font-size: 0.9rem;
}

.table tbody tr:hover {
    background: #f1f3f9;
    cursor: pointer;
}

.badge-success {
    background: #28a7451a;
    color: #28a745;
    border-radius: 20px;
    font-weight: 500;
}

.badge-warning {
    background: #ffc1071a;
    color: #ffc107;
    border-radius: 20px;
    font-weight: 500;
}
.modal-content {
    border-radius: 0.75rem;
    border: none;
    box-shadow: 0 5px 20px rgba(0,0,0,0.2);
}

.modal-header {
    background: #ffae00;
    color: #fff;
    border-radius: 0.75rem 0.75rem 0 0;
}
.btn-xs {
    padding: 2px 6px;
    font-size: 0.7rem;
    line-height: 1.2;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Confirm deletion
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to delete this record?')) {
                    e.preventDefault();
                }
            });
        });

        // View details functionality
        document.querySelectorAll('.view-details').forEach(button => {
            button.addEventListener('click', function() {
                const recordId = this.getAttribute('data-record-id');
                
                // In a real application, you would fetch this data from the server
                // For this example, we'll use a simple approach
                const row = this.closest('tr');
                const cells = row.querySelectorAll('td');
                
                const details = `
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Record ID:</strong> ${cells[0].textContent}</p>
                            <p><strong>User:</strong> ${cells[1].textContent}</p>
                            <p><strong>Record Type:</strong> ${cells[2].textContent}</p>
                            <p><strong>Details:</strong> ${cells[3].textContent}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Duration:</strong> ${cells[4].textContent}</p>
                            <p><strong>Semester:</strong> ${cells[5].textContent}</p>
                            <p><strong>Verification:</strong> ${cells[6].innerText}</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="text-center">
                            <a href="/related-records/${recordId}/edit" class="btn btn-warning btn-sm mr-2">
                                <i class="fas fa-edit"></i> Edit Record
                            </a>
                        </p>
                    </div>
                `;
                
                document.getElementById('recordDetails').innerHTML = details;
                $('#detailModal').modal('show');
            });
        });

        // Simple client-side filtering
        const verifiedStatusFilter = document.getElementById('verifiedStatus');
        const recordTypeFilter = document.getElementById('recordType');
        const semesterFilter = document.getElementById('semesterFilter');

        if (verifiedStatusFilter && recordTypeFilter && semesterFilter) {
            verifiedStatusFilter.addEventListener('change', filterTable);
            recordTypeFilter.addEventListener('change', filterTable);
            semesterFilter.addEventListener('change', filterTable);

            // Apply initial filter on page load
            filterTable();
        }

        function filterTable() {
            const verifiedValue = verifiedStatusFilter.value;
            const recordTypeValue = recordTypeFilter.value.toLowerCase();
            const semesterValue = semesterFilter.value;

            const rows = document.querySelectorAll('#recordsTable tbody tr');

            rows.forEach(row => {
                const verifiedCell = row.cells[6].textContent.toLowerCase();
                const recordTypeCell = row.cells[2].textContent.toLowerCase();
                const semesterCell = row.cells[5].textContent.trim();

                let showRow = true;

                if (verifiedValue === 'verified' && !verifiedCell.includes('verified')) {
                    showRow = false;
                }

                if (verifiedValue === 'not_verified' && !verifiedCell.includes('pending')) {
                    showRow = false;
                }

                if (recordTypeValue && !recordTypeCell.includes(recordTypeValue)) {
                    showRow = false;
                }

                if (semesterValue && semesterCell !== semesterValue) {
                    showRow = false;
                }

                row.style.display = showRow ? '' : 'none';
            });
        }
    });
</script>
@endsection
