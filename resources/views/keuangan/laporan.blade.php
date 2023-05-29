@extends('layouts.main2')

@section('title')
    Dashboard
@endsection

@section('dashboard')
    active
@endsection

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.css" />
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <h5 class="card-header">Laporan Keuangan</h5>
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
            <div class="mb-4">
                <a href="{{ url("detail_penyewa_keuangan/$ids") }}" class="btn btn-warning">Kembali</a>
            <a href="{{ url("print/$id") }}" target="_blank" class="btn btn-danger">Print</a>
            </div>
            <div>
                <div class="card-datatable text-nowrap">
                    <div class="table-responsive" style="overflow-x: scroll">
                        <table class="datatables-ajax table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Penyedia</th>
                                    <th>Nama Alat</th>
                                    <th>Unit</th>
                                    <th>Dibayar</th>
                                    <th>Lama Nyewa</th> 
                                    <th>Dibuat</th>
                                    <th>Jatuh Tempo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $row)
                                @php
                                    $nyewar = App\Models\NyewaModel::where("id", $row->nyewa_id)->first();
                                    $penyedia = App\Models\PenyewaanModel::where("id", $nyewar->penyewaan_id)->first();
                                    $alat = App\Models\AlatModel::where("id", $penyedia->nama_alat)->first();
                                @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $penyedia->nama_penyedia }}</td>
                                        <td>{{ $penyedia->alat->nama }}</td>
                                        <td>{{ $nyewar->unit_sewa }} Unit</td>
                                        <td>Rp. {{ number_format($row->nominal, 0) }}</td>
                                        <td>{{ $nyewar->lama_nyewa}} Hari</td>
                                        <td>{{ date("d, F Y",strtotime($row->created_at)) }}</td>
                                        <td>{{ date("d, F Y",strtotime($nyewar->jatuh_tempo)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
            });
        </script>
    @endsection
