@extends('layouts.app')

@section('title', 'Lomba')
@section('page-heading', 'Lomba')

@section('content')
<div class="container-fluid py-4">
        <div class="card">
            <div class="card-body">
                <h2 class="h4 text-dark">Edit Lomba</h2>

                <form action="{{ route('lomba.update', $lomba->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Nama Lomba</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $lomba->title }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="organizer" class="form-label">Penyelenggara</label>
                        <input type="text" class="form-control" id="organizer" name="organizer" value="{{ $lomba->organizer }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ $lomba->date }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('lomba') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>

@endsection