@extends('layouts.app')

@section('title', 'Fakultas')
@section('page-heading', 'Fakultas')

@section('content')
<div class="container-fluid py-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 text-dark" style="color: #163357 !important;">Daftar Fakultas</h2>
                    <a href="{{ route('fakultas.create') }}" class="btn btn-primary">Tambah Fakultas</a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nama Fakultas</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($fakultas as $f)
                                <tr>
                                    <td>{{ $f->name }}</td>
                                    <td>{{ $f->description }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('fakultas.edit', $f->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('fakultas.destroy', $f->id) }}" method="POST" style="display:inline-block;" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Belum ada data fakultas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection