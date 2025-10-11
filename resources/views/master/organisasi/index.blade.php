@extends('layouts.app')

@section('title', 'Organisasi')
@section('page-heading', 'Organisasi')

@section('content')
<div class="container-fluid py-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 text-dark" style="color: #163357 !important;">Daftar Organisasi</h2>
                    <a href="{{ route('organisasi.create') }}" class="btn btn-primary">Tambah Organisasi</a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nama Organisasi</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($organizations as $organization)
                                <tr>
                                    <td>{{ $organization->name }}</td>
                                    <td>{{ $organization->description }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('organisasi.edit', $organization->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('organisasi.destroy', $organization->id) }}" method="POST" style="display:inline-block;" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Belum ada data organisasi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection