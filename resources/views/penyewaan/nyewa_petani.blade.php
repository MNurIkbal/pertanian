@extends('layouts.main2')

@section('title')
    Dashboard
@endsection

@section('dashboard')
    active
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <h5 class="card-header">Penyewaan Alat</h5>
            <br>
            @if (session('success'))
                <div class="alert alert-success">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-success">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            <div>
                <a class="btn btn-primary mb-3" href="{{ url('tambah_data_nyewa') }}">Tambah</a>
                <div class="card-datatable text-nowrap">
                    <table class="datatables-ajax table table-bordered" id="tab">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Alat</th>
                                <th>Jenis</th>
                                <th>Satuan</th>
                                <th>Biaya</th>
                                <th>Expired</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($result as $row)
                            @php
                                $da = App\Models\PenyewaanModel::where("id",$row->penyewaan_id)->first();
                            @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('assets/img/' . $da->img) }}"
                                            style="width: 70px;height: 70px;" alt="">
                                    </td>
                                    <td>{{ $da->nama_nyewa }}</td>
                                    <td>{{ $da->jenis }}</td>
                                    <td>{{ $da->satuan }}</td>
                                    <td>Rp. {{ number_format($da->biaya, 0) }} Perbulan</td>
                                    <td>{{ $da->unit }} Unit</td>
                                    <td>{{ date('d, F Y', strtotime($da->expired)) }}</td>
                                    <td>
                                        <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $da->id }}"><i class="fas fa-pen"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#hapus{{ $da->id }}"><i class="fas fa-trash"></i></a>
                                        
                                        <div class="modal fade" id="hapus{{ $da->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog  modal-lg" role="document">
                                                <form method="POST" enctype="multipart/form-data" class="modal-content"
                                                    action="{{ url('edit_nyewa') }}">
                                                    <input type="hidden" name="id" value="{{ $row->id }}">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalFullTitle">Hapus Alat</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                       <h4>Apakah Anda Yakin Ingin Menghapus!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-label-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="{{ url("hapus_nyewa/$row->id") }}" class="btn btn-primary">Hapus</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script>
            $("#.tab").DataTables();
        </script>
    @endsection
