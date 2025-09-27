@extends('layouts.app')

@section('title', 'Edit Program Studi')
@section('page-heading', 'Program Studi')

@section('content')
<div class="container-fluid py-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 text-dark" style="color: #163357 !important;"">Daftar Program Studi</h2>
                    <a href="{{ route('prodi.create') }}" class="btn btn-primary">Tambah Program Studi</a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Fakultas</th>
                                <th scope="col">Nama Program Studi</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($prodis as $prodi)
                                <tr>
                                    <td>{{ $prodi->fakultas->name ?? 'N/A' }}</td>
                                    <td>{{ $prodi->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('prodi.edit', $prodi->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('prodi.destroy', $prodi->id) }}" method="POST" style="display:inline-block;" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Belum ada data program studi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection