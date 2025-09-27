@extends('layouts.app')

@section('title', 'Organisasi')
@section('page-heading', 'Organisasi')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-body">
                <h2 class="h4 text-dark">Edit Organisasi</h2>

                <form action="{{ route('organisasi.update', $organisasi->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Organisasi</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $organisasi->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ $organisasi->description }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('organisasi') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection