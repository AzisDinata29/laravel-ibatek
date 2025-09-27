@extends('layouts.app')
@section('title', 'Edit-tipe')
@section('page-heading', 'Edit tipe')
@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-body">
            <h2 class="h4 text-dark">Edit tipe</h2>
            <form action="{{ route('tipe.update', $tipe) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama tipe</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $tipe->name }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="{{ route('tipe.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection