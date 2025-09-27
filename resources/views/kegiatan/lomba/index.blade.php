@extends('layouts.app')

@section('title', 'Lomba')
@section('page-heading', 'Lomba')

@section('content')
<div class="container-fluid py-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 text-dark" style="color: #163357 !important;">Daftar Lomba</h2>
                    <a href="{{ route('lomba.create') }}" class="btn btn-primary">Tambah Lomba</a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nama Lomba</th>
                                <th scope="col">Penyelenggara</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($lombas as $lomba)
                                <tr>
                                    <td>{{ $lomba->title }}</td>
                                    <td>{{ $lomba->organizer }}</td>
                                    <td>{{ $lomba->date }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('lomba.edit', $lomba->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('lomba.destroy', $lomba->id) }}" method="POST" style="display:inline-block;" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada data lomba.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection