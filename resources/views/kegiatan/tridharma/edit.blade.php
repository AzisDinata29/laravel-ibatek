@extends('layouts.app')

@section('title', 'Tridharma')
@section('page-heading', 'Tridharma')

@section('content')

<div class="container-fluid py-4">
        <div class="card">
            <div class="card-body">
                <h2 class="h4 text-dark">Edit Data Tridharma</h2>

                <form action="{{ route('tridharma.update', $tridharma->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="type" class="form-label">Tipe (Penelitian/Pengabdian)</label>
                        <input type="text" class="form-control" id="type" name="type" value="{{ $tridharma->type }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $tridharma->title }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="researcher_name" class="form-label">Nama Peneliti</label>
                        <input type="text" class="form-control" id="researcher_name" name="researcher_name" value="{{ $tridharma->researcher_name }}">
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ $tridharma->date }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('tridharma') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection