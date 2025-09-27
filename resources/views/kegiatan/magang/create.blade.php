@extends('layouts.app')

@section('title', 'Magang')
@section('page-heading', 'Magang')

@section('content')
<div class="container-fluid py-4">
        <div class="card">
            <div class="card-body">
                <h2 class="h4 text-dark">Tambah Data Magang Baru</h2>

                <form action="{{ route('magang.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="company_name" class="form-label">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="position" class="form-label">Posisi</label>
                        <input type="text" class="form-control" id="position" name="position" required>
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('magang') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>

@endsection