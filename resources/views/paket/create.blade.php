@extends('layouts.backend.master')


@section('content')
<div class="container">
    <h1>Tambah Paket</h1>
    <form action="{{ route('paket.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_paket">Nama Paket</label>
            <input type="text" name="nama_paket" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="text" name="harga" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fitur">Fitur</label>
            <textarea name="fitur" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
