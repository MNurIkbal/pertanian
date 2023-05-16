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
            <h5 class="card-header">Keuangan</h5>
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
                <div class="card-datatable text-nowrap">
                    <div class="table-responsive" style="overflow-x: scroll">
                        <table class="datatables-ajax table table-bordered" id="tab">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Nama Penyewa</th>
                                    <th>Nama Alat</th>
                                    <th>Luas Tanah</th>
                                    <th>Biaya</th>
                                    <th>Unit</th>
                                    <th>Tanggal Sewa</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ asset('assets/img/' . $row->img) }}"
                                                style="width: 70px;height: 70px;" alt="">
                                        </td>
                                        <td>{{ $row->nama_nyewa }}</td>
                                        <td>{{ $row->jenis }}</td>
                                        <td>{{ $row->satuan }}</td>
                                        <td>Rp. {{ number_format($row->biaya, 0) }} Perbulan</td>
                                        <td>{{ $row->unit }} Unit</td>
                                        <td>{{ date('d, F Y', strtotime($row->expired)) }}</td>
                                        <td>
                                            <a href="{{ url("detail_penyewa_keuangan/$row->id") }}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $("#.tab").DataTables();
        </script>
    @endsection
