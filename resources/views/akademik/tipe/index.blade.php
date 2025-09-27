@extends('layouts.app')

@section('title', 'tipe')
@section('page-heading', 'tipe')

@section('content')
<div class="container-fluid py-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 text-dark" style="color: #163357 !important;">Daftar Aktivitas Mahasiswa</h2>
                    <a href="{{ route('tipe.create') }}" class="btn btn-primary">Tambah Aktivitas Mahasiswa</a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nama Aktivitas Mahasiswa</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tipe as $f)
                                <tr>
                                    <td>{{ $f->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('tipe.edit', $f->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('tipe.destroy', $f->id) }}" method="POST" style="display:inline-block;" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Belum ada data Aktivitas Mahasiswa.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection