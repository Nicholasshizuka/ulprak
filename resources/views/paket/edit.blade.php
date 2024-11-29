@extends('layouts.backend.master')


@section('content')
<div class="container">
    <h1>Edit Paket</h1>
    <form action="{{ route('paket.update', $paket->id_paket) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_paket">Nama Paket</label>
            <input type="text" name="nama_paket" class="form-control" value="{{ $paket->nama_paket }}" required>
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="text" name="harga" class="form-control" value="{{ $paket->harga }}" required>
        </div>
        <div class="form-group">
            <label for="fitur">Fitur</label>
            <textarea name="fitur" class="form-control" rows="3" required>{{ $paket->fitur }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
