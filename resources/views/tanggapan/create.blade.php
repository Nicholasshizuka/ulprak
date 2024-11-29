@extends('layouts.backend.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tanggapan</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('tanggapan.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_pesanan" value="{{ $id_pesanan }}">
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                        <div class="form-group">
                            <label for="tgl_tanggapan">Tanggal Tanggapan</label>
                            <input type="date" id="tgl_tanggapan" name="tgl_tanggapan" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggapan">Tanggapan</label>
                            <textarea id="tanggapan" name="tanggapan" class="form-control" rows="4" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control" required>
                                <option value="Proses">Proses</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Kirim Tanggapan</button>
                        <a href="{{ route('pesanan.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
