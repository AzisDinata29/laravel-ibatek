@extends('layouts.app')

@section('title', 'Related Records Management')
@section('page-heading', 'Manage Related Records')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Related Records Report</h6>
            <a href="{{ route('related-records.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Create New Record
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
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Report Filters
                                    </div>
                                    <form class="form-inline">
                                        <div class="form-group mr-2 mb-2">
                                            <label for="verifiedStatus" class="sr-only">Verification Status</label>
                                            <select class="form-control form-control-sm" id="verifiedStatus">
                                                <option value="">All Verification Status</option>
                                                <option value="verified" selected>Verified Only</option>
                                                <option value="not_verified">Not Verified Only</option>
                                            </select>
                                        </div>
                                        <div class="form-group mr-2 mb-2">
                                            <label for="recordType" class="sr-only">Record Type</label>
                                            <select class="form-control form-control-sm" id="recordType">
                                                <option value="">All Record Types</option>
                                                <option value="organization">Organization</option>
                                                <option value="kepanitiaan">Kepanitiaan</option>
                                                <option value="magang">Magang</option>
                                                <option value="tridharma">Tridharma</option>
                                                <option value="lomba">Lomba</option>
                                            </select>
                                        </div>
                                        <div class="form-group mr-2 mb-2">
                                            <label for="semesterFilter" class="sr-only">Semester</label>
                                            <select class="form-control form-control-sm" id="semesterFilter">
                                                <option value="">All Semesters</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-sm mb-2">
                                            <i class="fas fa-filter"></i> Apply Filters
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
                            <th>User</th>
                            <th>Record Type</th>
                            <th>Details</th>
                            <th>Duration</th>
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
                                @if($record->verified_by)
                                    <br><small>By: {{ $record->verifiedBy->name ?? '-' }}</small>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('related-records.edit', $record->id) }}" 
                                       class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('related-records.destroy', $record->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @if(!$record->is_verified)
                                        <form action="{{ route('related-records.verify', $record->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Verify">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <button type="button" class="btn btn-sm btn-outline-info view-details" 
                                            data-record-id="{{ $record->id }}" title="View Details">
                                        <i class="fas fa-eye"></i>
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
    .card {
        border: 1px solid #e3e6f0;
        border-radius: 0.35rem;
    }
    .table th {
        border-top: 1px solid #e3e6f0;
    }
    .badge {
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
    }
    .btn-group .btn {
        border-radius: 0.35rem;
        margin-right: 0.25rem;
    }
    #recordsTable {
        font-size: 0.875rem;
    }
    @media print {
        .btn, .form-inline, .card-header .btn {
            display: none !important;
        }
        .card-header {
            display: flex;
            justify-content: center;
        }
        .table-responsive {
            overflow: visible;
        }
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