<!-- resources/views/pesanan/show.blade.php -->

@extends('layouts.backend.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Pesanan</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID Pesanan</th>
                            <td>{{ $pesanan->pesanan_id }}</td> <!-- Update field to 'pesanan_id' -->
                        </tr>
                        <tr>
                            <th>Paket</th>
                            <td>{{ $pesanan->paket->nama_paket }}</td> <!-- Display the nama_paket from the related Paket model -->
                        </tr>
                        <tr>
                            <th>Detail</th>
                            <td>{{ $pesanan->detail }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Pesanan</th>
                            <td>{{ $pesanan->tgl_pesanan }}</td>
                        </tr>
                        <tr>
                            <th>Foto</th>
                            <td>
                                @if($pesanan->foto)
                                    <img src="{{ asset('images/pesanan/' . $pesanan->foto) }}" alt="Foto" width="100">
                                @else
                                    Tidak ada foto
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge badge-{{ $pesanan->status == 'Proses' ? 'warning' : 'success' }}">
                                    {{ $pesanan->status }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggapan</th>
                            <td>
                                @if(empty($pesanan->tanggapan->tanggapan))
                                    <div>
                                        <b>Tidak ada tanggapan</b>
                                    </div>
                                @else
                                    <div>
                                        <b>{{ $pesanan->tanggapan->tanggapan }}</b>
                                    </div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            @if(Auth::user()->role != 0)
                                @if($pesanan->tanggapan)
                                    <div class="form-group">
                                        <a href="{{ route('tanggapan.edit', $pesanan->tanggapan->id) }}"><button>Edit Tanggapan</button></a>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <a href="{{ url('tanggapan/create?id_pesanan=' . $pesanan->id_pesanan) }}"><button>Beri Tanggapan</button></a>
                                    </div>
                                @endif

                            @endif
                        </tr>
                    </table>
                    <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
