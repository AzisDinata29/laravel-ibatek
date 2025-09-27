@extends('layouts.app')

@section('title', 'Create-tipe')
@section('page-heading', 'Create tipe')

@section('content')
<div class="container-fluid py-4">
        <div class="card">
            <div class="card-body">
                <h2 class="h4 text-dark">Tambah tipe Baru</h2>

                <form action="{{ route('tipe.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama tipe</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('tipe.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection