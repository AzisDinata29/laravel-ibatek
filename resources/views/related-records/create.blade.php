@extends('layouts.app')

@section('title', 'Tambah Kegiatan')
@section('page-heading', 'Tambah Kegiatan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Form Section -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Kegiatan</h6>
                    <div>
                        <a href="{{ route('related-records.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('related-records.store') }}" method="POST" enctype="multipart/form-data" id="recordForm">
                        @csrf
                        
                        <!-- Record Type Selection -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="font-weight-bold mb-3">Tipe Kegiatan</h5>
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <button type="button" class="btn btn-outline-primary record-type-btn active" data-type="organization">
                                        <i class="fas fa-building me-1"></i> Organisasi
                                    </button>
                                    <button type="button" class="btn btn-outline-primary record-type-btn" data-type="kepaniitiaan">
                                        <i class="fas fa-users me-1"></i> Kepanitiaan
                                    </button>
                                    <button type="button" class="btn btn-outline-primary record-type-btn" data-type="magang">
                                        <i class="fas fa-briefcase me-1"></i> Magang
                                    </button>
                                    <button type="button" class="btn btn-outline-primary record-type-btn" data-type="tridharma">
                                        <i class="fas fa-graduation-cap me-1"></i> Tridharma
                                    </button>
                                    <button type="button" class="btn btn-outline-primary record-type-btn" data-type="lomba">
                                        <i class="fas fa-trophy me-1"></i> Lomba
                                    </button>
                                    <button type="button" class="btn btn-outline-primary record-type-btn" data-type="ukm">
                                        <i class="fas fa-icons me-1"></i> UKM
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Record Selection Fields -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="record-selection" id="organization-selection">
                                    <label for="organization_id">Jenis Organisasi</label>
                                    <select name="organization_id" id="organization_id" class="form-control">
                                        <option value="">Jenis Organisasi</option>
                                        @foreach($organizations as $org)
                                        <option value="{{ $org->id }}">{{ $org->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="record-selection d-none" id="kepaniitiaan-selection">
                                    <label for="kepaniitiaan_id">Jenis Kepanitiaan</label>
                                    <select name="kepaniitiaan_id" id="kepaniitiaan_id" class="form-control">
                                        <option value="">Jenis Kepanitiaan</option>
                                        @foreach($kepaniitiaans as $kep)
                                        <option value="{{ $kep->id }}">{{ $kep->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="record-selection d-none" id="magang-selection">
                                    <label for="magang_id">Jenis Magang</label>
                                    <select name="magang_id" id="magang_id" class="form-control">
                                        <option value="">Jenis Magang</option>
                                        @foreach($magangs as $mag)
                                        <option value="{{ $mag->id }}">{{ $mag->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="record-selection d-none" id="tridharma-selection">
                                    <label for="tridharma_id">Jenis Tridharma</label>
                                    <select name="tridharma_id" id="tridharma_id" class="form-control">
                                        <option value="">Jenis Tridharma</option>
                                        @foreach($tridharmas as $tri)
                                        <option value="{{ $tri->id }}">{{ $tri->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="record-selection d-none" id="lomba-selection">
                                    <label for="lomba_id">Jenis Lomba</label>
                                    <select name="lomba_id" id="lomba_id" class="form-control">
                                        <option value="">Jenis Lomba</option>
                                        @foreach($lombas as $lom)
                                        <option value="{{ $lom->id }}">{{ $lom->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="record-selection d-none" id="ukm-selection">
                                    <label for="ukm_id">Jenis UKM</label>
                                    <select name="ukm_id" id="ukm_id" class="form-control">
                                        <option value="">Jenis UKM</option>
                                        @foreach($ukms as $ukm)
                                        <option value="{{ $ukm->id }}">{{ $ukm->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="font-weight-bold mb-3">Informasi Tambahan</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="semester">Semester</label>
                                            <select name="semester" id="semester" class="form-control" required>
                                                <option value="">Pilih Semester</option>
                                                @for($i = 1; $i <= 8; $i++)
                                                    <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="durasi">Durasi (Menit)</label>
                                            <input type="number" name="durasi" id="durasi" class="form-control" min="0" value="{{ old('durasi') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="bukti_file">Upload Dokumentasi</label>
                                    <div class="custom-file">
                                        <input type="file" name="bukti_file" id="bukti_file" class="custom-file-input" accept=".pdf,.jpg,.jpeg,.png">
                                        <label class="custom-file-label" for="bukti_file">Jenis file (PDF, JPG, PNG, max 2MB)</label>
                                    </div>
                                    <small class="form-text text-danger">Unggah dokumentasi pendukung untuk verifikasi</small>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i> Kirim
                                </button>
                                <button type="reset" class="btn btn-outline-secondary">
                                    <i class="fas fa-redo me-1"></i> Reset
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Existing Records Summary -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ringkasan Kegiatan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" id="existing-records-table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Type</th>
                                    <th>Nama</th>
                                    <th>Semester</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($relatedRecords as $record)
                                <tr class="record-row" data-semester="{{ $record->semester ?? '' }}">
                                    <td>
                                        @if($record->organization_id) Organisasi
                                        @elseif($record->kepaniitiaan_id) Kepanitiaan
                                        @elseif($record->magang_id) Magang
                                        @elseif($record->tridharma_id) Tridharma
                                        @elseif($record->lomba_id) Lomba
                                        @elseif($record->ukm_id) UKM
                                        @else Other
                                        @endif
                                    </td>
                                    <td class="text-truncate" style="max-width: 120px;" title="
                                        @if($record->organization_id) {{ $record->organization->name ?? '-' }}
                                        @elseif($record->kepaniitiaan_id) {{ $record->kepaniitiaan->name ?? '-' }}
                                        @elseif($record->magang_id) {{ $record->magang->company_name ?? '-' }}
                                        @elseif($record->tridharma_id) {{ $record->tridharma->title ?? '-' }}
                                        @elseif($record->lomba_id) {{ $record->lomba->title ?? '-' }}
                                        @elseif($record->ukm_id) {{ $record->ukm->name ?? '-' }}
                                        @else - @endif
                                    ">
                                        @if($record->organization_id) {{ $record->organization->name ?? '-' }}
                                        @elseif($record->kepaniitiaan_id) {{ $record->kepaniitiaan->name ?? '-' }}
                                        @elseif($record->magang_id) {{ $record->magang->company_name ?? '-' }}
                                        @elseif($record->tridharma_id) {{ $record->tridharma->title ?? '-' }}
                                        @elseif($record->lomba_id) {{ $record->lomba->title ?? '-' }}
                                        @elseif($record->ukm_id) {{ $record->ukm->name ?? '-' }}
                                        @else - @endif
                                    </td>
                                    <td>{{ $record->semester ?? '-' }}</td>
                                    <td>
                                        <span class="badge {{ $record->is_verified ? 'badge-success' : 'badge-warning' }}">
                                            {{ $record->is_verified ? 'Verified' : 'Pending' }}
                                        </span>
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
</div>

<style>
    .card {
        border: 1px solid #e3e6f0;
        border-radius: 0.35rem;
    }
    .card-header {
        background-color: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
    }
    .record-type-btn {
        border-radius: 0.35rem;
        transition: all 0.2s;
    }
    .record-type-btn.active, .record-type-btn:hover {
        background-color: #ff9900;
        color: rgb(255, 255, 255);
        border-color: #fcbe62;;
    }
    .record-selection {
        border-left: 3px solid #ff9900;;
        padding: 15px;
        background-color: #f8f9fc;
        border-radius: 0.35rem;
        margin-top: 10px;
    }
    .custom-file-label::after {
        content: "Browse";
    }
    #existing-records-table {
        font-size: 0.8rem;
    }
    #existing-records-table tr {
        transition: all 0.2s;
    }
    #existing-records-table tr:hover {
        background-color: #f8f9fc;
    }
    .badge {
        font-size: 0.7rem;
        padding: 0.35em 0.65em;
    }
    .badge-success {
    background: #28a7451a;
    color: #28a745;
    border-radius: 20px;
    font-weight: 500;
}

.badge-warning {
    background: #ffc1071a;
    color: #000000;
    border-radius: 20px;
    font-weight: 500;
}
    @media print {
        .btn, .custom-file, .form-text, .progress {
            display: none !important;
        }
        .card {
            border: 1px solid #000;
            page-break-inside: avoid;
        }
        .record-selection {
            border: 1px solid #000;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Semester filter functionality
        const semesterFilter = document.getElementById('display_semester');
        if (semesterFilter) {
            semesterFilter.addEventListener('change', function() {
                const semester = this.value;
                const rows = document.querySelectorAll('#existing-records-table .record-row');
                
                rows.forEach(function(row) {
                    if (semester === 'all' || row.getAttribute('data-semester') === semester) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
            
            // Trigger on load
            semesterFilter.dispatchEvent(new Event('change'));
        }

        // Record type selection functionality
        const recordTypeButtons = document.querySelectorAll('.record-type-btn');
        const recordSelections = document.querySelectorAll('.record-selection');
        
        recordTypeButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                recordTypeButtons.forEach(btn => btn.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');
                
                // Hide all record selections
                recordSelections.forEach(selection => selection.classList.add('d-none'));
                
                // Show the selected record type
                const recordType = this.getAttribute('data-type');
                const selectedElement = document.getElementById(`${recordType}-selection`);
                if (selectedElement) {
                    selectedElement.classList.remove('d-none');
                }
            });
        });

        // File input label update
        const fileInput = document.getElementById('bukti_file');
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                const fileName = this.files[0]?.name || 'Choose file';
                this.nextElementSibling.textContent = fileName;
            });
        }

        // Form validation
        const form = document.getElementById('recordForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                let isValid = true;
                const semester = document.getElementById('semester');
                const durasi = document.getElementById('durasi');
                
                if (!semester.value) {
                    isValid = false;
                    semester.classList.add('is-invalid');
                } else {
                    semester.classList.remove('is-invalid');
                }
                
                if (!durasi.value || durasi.value < 0) {
                    isValid = false;
                    durasi.classList.add('is-invalid');
                } else {
                    durasi.classList.remove('is-invalid');
                }
                
                if (!isValid) {
                    e.preventDefault();
                    alert('Please fill all required fields correctly.');
                }
            });
        }
    });
</script>
@endsection
