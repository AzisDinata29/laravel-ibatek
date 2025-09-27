@extends('layouts.app')

@section('title', 'Kepanitiaan')
@section('page-heading', 'Kepanitiaan')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-body">
                <h2 class="h4 text-dark">Edit Kepanitiaan</h2>

                <form action="{{ route('kepanitiaan.update', $kepanitiaan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="event_name" class="form-label">Nama Acara</label>
                        <input type="text" class="form-control" id="event_name" name="event_name" value="{{ $kepanitiaan->event_name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kepanitiaan</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $kepanitiaan->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $kepanitiaan->start_date }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $kepanitiaan->end_date }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('kepanitiaan') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection