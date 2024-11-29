@extends('layouts.backend.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Pesanan</h6>
                </div>
                <div class="card-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success">
                            {{ Session::get('message') }}
                        </div>
                    @endif

                    <a href="{{ route('pesanan.create') }}" class="btn btn-primary btn-sm mb-3">
                        <i class="fas fa-plus-circle"></i> Tambah Pesanan
                    </a>
                    @if(Auth::user()->role != 0)
                        <a href="{{ route('paket.create') }}" class="btn btn-primary btn-sm mb-3">
                            <i class="fas fa-edit"></i> Tambah Paket
                        </a>      

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pesanan</th>
                                    <th>Detail</th>
                                    <th>Foto</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pesanans as $key => $pesanan)
                                    <tr>
                                        <td>{{ $key + $pesanans->firstItem() }}</td>
                                        <td>{{ $pesanan->tgl_pesanan }}</td>
                                        <td>{{ Str::limit($pesanan->detail, 50) }}</td>
                                        <td>
                                            @if($pesanan->foto)
                                                <img src="{{ asset('images/pesanan/' . $pesanan->foto) }}" alt="Foto" width="50">
                                            @else
                                                Tidak ada foto
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $pesanan->status == 'Proses' ? 'warning' : 'success' }}">
                                                {{ $pesanan->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="{{ route('pesanan.show', $pesanan->id_pesanan) }}" class="btn btn-primary btn-sm">View Details</a>

                                                <a href="{{ route('pesanan.edit', $pesanan->id_pesanan) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>

                                                <form action="{{ route('pesanan.destroy', $pesanan->id_pesanan) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">
                                                        <i class="fas fa-trash-alt"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada pesanan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                            @forelse($pakets as $paket)
                                <tr>
                                    <td>{{ $paket->id_paket }}</td>
                                    <td>{{ $paket->nama_paket }}</td>
                                    <td>{{ $paket->harga }}</td>
                                    <td>{{ $paket->fitur }}</td>
                                    <td>
                                        <a href="{{ route('paket.edit', $paket->id_paket) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('paket.destroy', $paket->id_paket) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button  class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada paket yang ditambahkan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @else
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pesanan</th>
                                    <th>Detail</th>
                                    <th>Foto</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pesanans as $key => $pesanan)
                                    <tr>
                                        <td>{{ $key + $pesanans->firstItem() }}</td>
                                        <td>{{ $pesanan->tgl_pesanan }}</td>
                                        <td>{{ Str::limit($pesanan->detail, 50) }}</td>
                                        <td>
                                            @if($pesanan->foto)
                                                <img src="{{ asset('images/pesanan/' . $pesanan->foto) }}" alt="Foto" width="50">
                                            @else
                                                Tidak ada foto
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $pesanan->status == 'Proses' ? 'warning' : 'success' }}">
                                                {{ $pesanan->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="{{ route('pesanan.show', $pesanan->id_pesanan) }}" class="btn btn-primary btn-sm">View Details</a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada pesanan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    @endif    

                    <div class="d-flex justify-content-center">
                        {{ $pesanans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
