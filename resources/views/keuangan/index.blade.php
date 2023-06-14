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
                        <table class="datatables-ajax table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Penyedia</th>
                                    <th>Nama Alat</th>
                                    <th>Biaya</th>
                                    <th>Unit</th>
                                
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->nama_penyedia }}</td>
                                        <td>{{ $row->alat->nama }}</td>
                                        <td>Rp. {{ number_format($row->biaya, 0) }}</td>
                                        <td>{{ $row->unit }} Unit</td>
                                        <td>
                                            <a href="{{ url("detail_penyewa_keuangan/$row->id") }}" class="btn btn-sm btn-primary"><i class="fas fa-clipboard"></i></a>
                                        </td>
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
