@extends('layouts.app')

@section('title', 'Magang')
@section('page-heading', 'Magang')

@section('content')
<div class="container-fluid py-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 text-dark" style="color: #163357 !important;">Daftar Data Magang</h2>
                    <a href="{{ route('magang.create') }}" class="btn btn-primary">Tambah Data Magang</a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nama Perusahaan</th>
                                <th scope="col">Posisi</th>
                                <th scope="col">Tanggal Mulai</th>
                                <th scope="col">Tanggal Selesai</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($magangs as $magang)
                                <tr>
                                    <td>{{ $magang->company_name }}</td>
                                    <td>{{ $magang->position }}</td>
                                    <td>{{ $magang->start_date }}</td>
                                    <td>{{ $magang->end_date }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('magang.edit', $magang->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('magang.destroy', $magang->id) }}" method="POST" style="display:inline-block;" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data magang.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection