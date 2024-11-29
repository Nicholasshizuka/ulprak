@extends('layouts.backend.master')


@section('content')
<div class="container">
    <h1>Daftar Paket</h1>
    <a href="{{ route('paket.create') }}" class="btn btn-primary mb-3">Tambah Paket</a>

    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Paket</th>
                <th>Harga</th>
                <th>Fitur</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pakets as $paket)
                <tr>
                    <td>{{ $paket->id_paket }}</td>
                    <td>{{ $paket->nama_paket }}</td>
                    <td>{{ $paket->harga }}</td>
                    <td>{{ $paket->fitur }}</td>
                    <td>
                        <a href="{{ route('Paket.edit', $paket->id_paket) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('Paket.destroy', $paket->id_paket) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $pakets->links() }}
</div>
@endsection
