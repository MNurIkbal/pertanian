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
            <div>
                <h5 class="card-header">Detail Keuangan </h5>
            <h5 style="margin-left: 20px">Nama Penyewa : {{ $first->nama_penyedia }}</h5>
            <h5 style="margin-left: 20px">Nama ALat : {{ $first->nama_alat }}</h5>
            <h5 style="margin-left: 20px">Biaya : Rp.{{ number_format($first->biaya,0) }}</h5>
            </div>
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
                <a href="{{ url("keuangan") }}" class="btn btn-warning mb-4">Kembali</a>
                <div class="card-datatable text-nowrap">
                    <div class="table-responsive" style="overflow-x: scroll !important">
                        <table class="datatables-ajax table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No Hp</th>
                                    <th>Status</th>
                                    <th>Banyak Unit</th>
                                    <th>Lama Nyewa</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Alamat</th>
                                    <th>Dibuat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $row)
                                @php
                                    $users = App\Models\User::where('id',$row->user_id)->first();
                                @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $users->name }}</td>
                                        <td>{{ $row->no_hp }}</td>
                                        <td>
                                            @if ($row->status == "belum aktif")
                                                <span class="badge badge-pill badge-warning bg-warning">Belum Di ACC</span>
                                                @elseif ($row->status == "aktif")
                                                <span class="badge badge-pill badge-warning bg-success">Sudah Di ACC</span>
                                                @elseif ($row->status == "selesai")
                                                <span class="badge badge-pill badge-warning bg-primary">Selesai</span>
                                                @elseif ($row->status == "tolak")
                                                <span class="badge badge-pill badge-warning bg-danger">Tolak</span>
                                            @endif
                                        </td>
                                        <td>{{ $row->unit_sewa }} Unit</td>
                                        <td>{{ $row->lama_nyewa }} Hari</td>
                                        <td>{{ date('d, F Y', strtotime($row->jatuh_tempo)) }}</td>
                                        <td>{{ $row->alamat }}</td>
                                        <td>{{ date('d, F Y', strtotime($row->created_at)) }}</td>
                                        <td>
                                            <a href="{{ url('bayar/' . $row->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-clipboard"></i></a>
                                            {{-- @if ($role == 1)
                                            @else
                                            <a href="{{ url('bayar_pekerjaan/' . $row->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-clipboard"></i></a>
                                            @endif --}}
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
