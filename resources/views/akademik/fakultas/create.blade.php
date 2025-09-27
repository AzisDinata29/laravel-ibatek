@extends('layouts.app')

@section('title', 'Create-Fakultas')
@section('page-heading', 'Create Fakultas')

@section('content')
<div class="container-fluid py-4">
        <div class="card">
            <div class="card-body">
                <h2 class="h4 text-dark">Tambah Fakultas Baru</h2>

                <form action="{{ route('fakultas.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Fakultas</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('fakultas') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection