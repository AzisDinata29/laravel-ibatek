@extends('layouts.app')

@section('title', 'Edit Program Studi')
@section('page-heading', 'Program Studi')

@section('content')

<div class="container-fluid py-4">
        <div class="card">
            <div class="card-body">
                <h2 class="h4 text-dark">Edit Program Studi</h2>

                <form action="{{ route('prodi.update', $prodi->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="fakultas_id" class="form-label">Fakultas</label>
                        <select class="form-control" id="fakultas_id" name="fakultas_id" required>
                            <option value="">Pilih Fakultas</option>
                            @foreach ($fakultas as $item)
                                <option value="{{ $item->id }}" {{ $prodi->fakultas_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Program Studi</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $prodi->name }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('prodi') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection