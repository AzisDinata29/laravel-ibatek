@extends('layouts.app')

@section('title', 'Kepanitiaan')
@section('page-heading', 'Kepanitiaan')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 text-dark" style="color: #163357 !important;">Daftar Kepanitiaan</h2>
                    <a href="{{ route('kepanitiaan.create') }}" class="btn btn-primary">Tambah Kepanitiaan</a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nama Acara</th>
                                <th scope="col">Nama Kepanitiaan</th>
                                <th scope="col">Tanggal Mulai</th>
                                <th scope="col">Tanggal Selesai</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kepaniitiaans as $kepanitiaan)
                                <tr>
                                    <td>{{ $kepanitiaan->event_name }}</td>
                                    <td>{{ $kepanitiaan->name }}</td>
                                    <td>{{ $kepanitiaan->start_date }}</td>
                                    <td>{{ $kepanitiaan->end_date }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('kepanitiaan.edit', $kepanitiaan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('kepanitiaan.destroy', $kepanitiaan->id) }}" method="POST" style="display:inline-block;" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data kepanitiaan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection