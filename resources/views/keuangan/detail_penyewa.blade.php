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
            <div>
                <h5 class="card-header">Detail Keuangan </h5>
            <h5 style="margin-left: 20px">Nama Penyewa : {{ $first->nama_nyewa }}</h5>
            <h5 style="margin-left: 20px">Nama ALat : {{ $first->jenis }}</h5>
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
                    <table class="datatables-ajax table table-bordered" id="tab">
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
                                    <td>{{ $row->status }}</td>
                                    <td>{{ $row->unit_sewa }}</td>
                                    <td>{{ $row->lama_nyewa }}</td>
                                    <td>{{ date('d, F Y', strtotime($row->jatuh_tempo)) }}</td>
                                    <td>{{ $row->alamat }}</td>
                                    <td>{{ date('d, F Y', strtotime($row->created_at)) }}</td>
                                    <td>
                                        @if ($role == 1)
                                        <a href="{{ url('bayar/' . $row->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                        @else
                                        <a href="{{ url('bayar_pekerjaan/' . $row->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                        @endif
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
