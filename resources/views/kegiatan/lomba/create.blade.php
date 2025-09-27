@extends('layouts.app')

@section('title', 'Lomba')
@section('page-heading', 'Lomba')

@section('content')
<div class="container-fluid py-4">
        <div class="card">
            <div class="card-body">
                <h2 class="h4 text-dark">Tambah Lomba Baru</h2>

                <form action="{{ route('lomba.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Nama Lomba</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="organizer" class="form-label">Penyelenggara</label>
                        <input type="text" class="form-control" id="organizer" name="organizer" required>
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('lomba') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>

@endsection