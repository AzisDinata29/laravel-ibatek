@extends('layouts.app')

@section('title', 'Tridharma')
@section('page-heading', 'Tridharma')

@section('content')
<div class="container-fluid py-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 text-dark" style="color: #163357 !important;">Daftar Data Tridharma</h2>
                    <a href="{{ route('tridharma.create') }}" class="btn btn-primary">Tambah Data Tridharma</a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Tipe</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Nama Peneliti</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tridharmas as $tridharma)
                                <tr>
                                    <td>{{ $tridharma->type }}</td>
                                    <td>{{ $tridharma->title }}</td>
                                    <td>{{ $tridharma->researcher_name }}</td>
                                    <td>{{ $tridharma->date }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('tridharma.edit', $tridharma->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('tridharma.destroy', $tridharma->id) }}" method="POST" style="display:inline-block;" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data tridharma.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection