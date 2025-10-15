@extends('layouts.app')

@section('title', 'Sertifikat Management')
@section('page-heading', 'Sertifikat Management')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Sertifikat Magang</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTables" class="table table-striped table-hover align-middle nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>NPM</th>
                                    <th>Fakultas</th>
                                    <th>Prodi</th>
                                    <th>Angkatan</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($magang as $row)
                                    <tr>
                                        <td>{{ $row->user->name }}</td>
                                        <td>{{ $row->user->npm }}</td>
                                        <td>{{ $row->user->fakultas_detail?->name }}</td>
                                        <td>{{ $row->user->prodi_detail?->name }}</td>
                                        <td>{{ $row->user->angkatan }}</td>
                                        <td>
                                            <a href="{{ route('user-magang.show', encrypt($row->id)) }}"
                                                class="btn btn-sm btn-info">Cetak</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
