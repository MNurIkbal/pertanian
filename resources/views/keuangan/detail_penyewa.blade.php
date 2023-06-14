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
            <h5 style="margin-left: 20px">Nama Alat : {{ $first->alat->nama }}</h5>
            <h5 style="margin-left: 20px">Pendapatan : Rp.{{ number_format($total->total_nominal,0) }}</h5>
            </div>
            <br>
            @if (session('success'))
                <div class="alert alert-success">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            <div>
                <a href="{{ url("keuangan") }}" class="btn btn-warning mb-4">Kembali</a>
                <a href="#" class="btn btn-primary mb-4" data-bs-toggle="modal"
                data-bs-target="#edit">Print</a>
                <div class="modal fade" id="edit" tabindex="-1"
                    aria-hidden="true">
                    <div class="modal-dialog  modal-lg" role="document">
                        <form method="POST" enctype="multipart/form-data" class="modal-content"
                            action="{{ url('print_laporan') }}">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalFullTitle">Print Laporan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <input type="hidden" name="id" value="{{ $id }}">
                           <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">Tanggal Mulai</label>
                                        <input type="date" name="start" value="" class="form-control" required autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">Tanggal Akhir</label>
                                        <input type="date" name="end" value="" class="form-control" required autofocus>
                                    </div>
                                </div>
                            </div>
                           </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
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
