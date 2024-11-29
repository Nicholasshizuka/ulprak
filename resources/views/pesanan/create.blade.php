@extends('layouts.backend.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Buat Pesanan</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('pesanan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="id_paket">Paket</label>
                            <select name="id_paket" class="form-control" id="id_paket" required>
                                <option value="">Pilih Paket</option>
                                @foreach($pakets as $paket)
                                    <option value="{{ $paket->id_paket }}">{{ $paket->nama_paket }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="detail">Detail</label>
                            <textarea name="detail" class="form-control" id="detail" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="tgl_pesanan">Tanggal pesanan</label>
                            <input type="date" id="tgl_pesanan" name="tgl_pesanan" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" name="foto" class="form-control" id="foto">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="status" class="form-control" value="Proses" id="status">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('home') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 