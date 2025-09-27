@extends('layouts.app')

@section('title', 'Edit Catatan')
@section('page-heading', 'Edit Catatan')

@section('content')
<div class="container">
    <form action="{{ route('related-records.update', $relatedRecord->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Semester Select for Display -->
        <div class="form-group mb-3">
            <label for="display_semester">Pilih Semester</label>
            <select id="display_semester" class="form-control">
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

        <!-- Horizontal Navigation Tabs -->
        <ul class="nav nav-tabs" id="formTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="organization-tab" data-bs-toggle="tab" data-bs-target="#organization" type="button" role="tab">Organisasi</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="kepaniitiaan-tab" data-bs-toggle="tab" data-bs-target="#kepaniitiaan" type="button" role="tab">Kepanitiaan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="magang-tab" data-bs-toggle="tab" data-bs-target="#magang" type="button" role="tab">Magang</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tridharma-tab" data-bs-toggle="tab" data-bs-target="#tridharma" type="button" role="tab">Tridharma</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="lomba-tab" data-bs-toggle="tab" data-bs-target="#lomba" type="button" role="tab">Lomba</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="ukm-tab" data-bs-toggle="tab" data-bs-target="#ukm" type="button" role="tab">UKM</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="bukti-tab" data-bs-toggle="tab" data-bs-target="#bukti" type="button" role="tab">Bukti</button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-3" id="formTabsContent">
            <div class="tab-pane fade show active" id="organization" role="tabpanel">
                <div class="form-group">
                    <label for="organization_id">Organisasi</label>
                    <select name="organization_id" id="organization_id" class="form-control">
                        <option value="">Pilih Organisasi</option>
                        @foreach($organizations as $org)
                            <option value="{{ $org->id }}" {{ $relatedRecord->organization_id == $org->id ? 'selected' : '' }}>{{ $org->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3">
                    <h6>Organisasi</h6>
                    <div id="organization-records">
                        @foreach($relatedRecords->whereNotNull('organization_id') as $record)
                            <div class="record-item" data-semester="{{ $record->semester }}" style="display: none;">
                                {{ $record->organization->name }} - Semester {{ $record->semester }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="kepaniitiaan" role="tabpanel">
                <div class="form-group">
                    <label for="kepaniitiaan_id">Kepanitiaan</label>
                    <select name="kepaniitiaan_id" id="kepaniitiaan_id" class="form-control">
                        <option value="">Pilih Kepanitiaan</option>
                        @foreach($kepaniitiaans as $kep)
                            <option value="{{ $kep->id }}" {{ $relatedRecord->kepaniitiaan_id == $kep->id ? 'selected' : '' }}>{{ $kep->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3">
                    <h6>Kepanitiaan</h6>
                    <div id="kepaniitiaan-records">
                        @foreach($relatedRecords->whereNotNull('kepaniitiaan_id') as $record)
                            <div class="record-item" data-semester="{{ $record->semester }}" style="display: none;">
                                {{ $record->kepaniitiaan->name }} - Semester {{ $record->semester }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="magang" role="tabpanel">
                <div class="form-group">
                    <label for="magang_id">Magang</label>
                    <select name="magang_id" id="magang_id" class="form-control">
                        <option value="">Pilih Magang</option>
                        @foreach($magangs as $mag)
                            <option value="{{ $mag->id }}" {{ $relatedRecord->magang_id == $mag->id ? 'selected' : '' }}>{{ $mag->company_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3">
                    <h6>Catatan Magang Anda untuk Semester Terpilih</h6>
                    <div id="magang-records">
                        @foreach($relatedRecords->whereNotNull('magang_id') as $record)
                            <div class="record-item" data-semester="{{ $record->semester }}" style="display: none;">
                                {{ $record->magang->company_name }} - Semester {{ $record->semester }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tridharma" role="tabpanel">
                <div class="form-group">
                    <label for="tridharma_id">Tridharma</label>
                    <select name="tridharma_id" id="tridharma_id" class="form-control">
                        <option value="">Pilih Tridharma</option>
                        @foreach($tridharmas as $tri)
                            <option value="{{ $tri->id }}" {{ $relatedRecord->tridharma_id == $tri->id ? 'selected' : '' }}>{{ $tri->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3">
                    <h6>Tridharma</h6>
                    <div id="tridharma-records">
                        @foreach($relatedRecords->whereNotNull('tridharma_id') as $record)
                            <div class="record-item" data-semester="{{ $record->semester }}" style="display: none;">
                                {{ $record->tridharma->title }} - Semester {{ $record->semester }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="lomba" role="tabpanel">
                <div class="form-group">
                    <label for="lomba_id">Lomba</label>
                    <select name="lomba_id" id="lomba_id" class="form-control">
                        <option value="">Pilih Lomba</option>
                        @foreach($lombas as $lom)
                            <option value="{{ $lom->id }}" {{ $relatedRecord->lomba_id == $lom->id ? 'selected' : '' }}>{{ $lom->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3">
                    <h6>Lomba</h6>
                    <div id="lomba-records">
                        @foreach($relatedRecords->whereNotNull('lomba_id') as $record)
                            <div class="record-item" data-semester="{{ $record->semester }}" style="display: none;">
                                {{ $record->lomba->title }} - Semester {{ $record->semester }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="ukm" role="tabpanel">
                <div class="form-group">
                    <label for="ukm_id">UKM</label>
                    <select name="ukm_id" id="ukm_id" class="form-control">
                        <option value="">Pilih UKM</option>
                        @foreach($ukms as $ukm)
                            <option value="{{ $ukm->id }}" {{ $relatedRecord->ukm_id == $ukm->id ? 'selected' : '' }}>{{ $ukm->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3">
                    <h6>UKM</h6>
                    <div id="ukm-records">
                        @foreach($relatedRecords->whereNotNull('ukm_id') as $record)
                            <div class="record-item" data-semester="{{ $record->semester }}" style="display: none;">
                                {{ $record->ukm->name }} - Semester {{ $record->semester }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="bukti" role="tabpanel">
                <div class="form-group">
                    <label for="bukti_file">Upload Bukti (PDF, JPG, PNG, max 2MB)</label>
                    <input type="file" name="bukti_file" id="bukti_file" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                    @if($relatedRecord->bukti_file)
                        <p>Current file: <a href="{{ Storage::url($relatedRecord->bukti_file) }}" target="_blank">View Bukti</a></p>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group mt-3">
            <label for="semester">Semester</label>
            <select name="semester" id="semester" class="form-control">
                <option value="">Select Semester</option>
                <option value="1" {{ old('semester', $relatedRecord->semester) == '1' ? 'selected' : '' }}>1</option>
                <option value="2" {{ old('semester', $relatedRecord->semester) == '2' ? 'selected' : '' }}>2</option>
                <option value="3" {{ old('semester', $relatedRecord->semester) == '3' ? 'selected' : '' }}>3</option>
                <option value="4" {{ old('semester', $relatedRecord->semester) == '4' ? 'selected' : '' }}>4</option>
                <option value="5" {{ old('semester', $relatedRecord->semester) == '5' ? 'selected' : '' }}>5</option>
                <option value="6" {{ old('semester', $relatedRecord->semester) == '5' ? 'selected' : '' }}>6</option>
                <option value="7" {{ old('semester', $relatedRecord->semester) == '5' ? 'selected' : '' }}>7</option>
                <option value="8" {{ old('semester', $relatedRecord->semester) == '5' ? 'selected' : '' }}>8</option>
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="durasi">Durasi (menit)</label>
            <input type="number" name="durasi" id="durasi" class="form-control" min="0" value="{{ old('durasi', $relatedRecord->durasi) }}">
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('related-records.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<script>
    document.getElementById('display_semester').addEventListener('change', function() {
        var semester = this.value;
        var items = document.querySelectorAll('.record-item');
        items.forEach(function(item) {
            if (item.getAttribute('data-semester') == semester) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });

    // Trigger on load for default
    window.addEventListener('load', function() {
        document.getElementById('display_semester').dispatchEvent(new Event('change'));
    });
</script>
@endsection
