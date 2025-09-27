@extends('layouts.app')

@section('title', 'Edit UKM')
@section('page-heading', 'Edit UKM')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-body">
            <h2 class="h4 text-dark" style="color: #163357 !important;">Edit UKM</h2>
            <form action="{{ route('ukm.update', $ukm->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama UKM</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $ukm->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ $ukm->description }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="{{ route('ukm.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
