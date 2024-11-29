<!-- resources/views/pesanan/edit.blade.php -->

@extends('layouts.backend.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Pesanan</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('pesanan.update', $pesanan->id_pesanan) }}" method="POST" enctype="multipart/form-data">


                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="id_paket">Paket</label>
                            <select name="id_paket" class="form-control" id="id_paket" required>
                                <option value="">Pilih Paket</option>
                                @foreach($pakets as $paket)
                                    <option value="{{ $paket->id_paket }}" 
                                            {{ $pesanan->id_paket == $paket->id_paket ? 'selected' : '' }}>
                                            {{ $paket->nama_paket }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="detail">Detail</label>
                            <textarea name="detail" class="form-control" id="detail" required>{{ $pesanan->detail }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="tgl_pesanan">Tanggal Pesanan</label>
                            <input type="date" name="tgl_pesanan" class="form-control" id="tgl_pesanan" value="{{ $pesanan->tgl_pesanan }}" required>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" name="foto" class="form-control" id="foto">
                            @if($pesanan->foto)
                                <img src="{{ asset('images/pesanan/' . $pesanan->foto) }}" alt="Foto" width="100">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" id="status" required>
                                <option value="Proses" {{ $pesanan->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                <option value="Selesai" {{ $pesanan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('home') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
