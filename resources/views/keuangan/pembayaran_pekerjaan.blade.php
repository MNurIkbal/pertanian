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
            <h5 class="card-header">Pembayaran </h5>
            <div style="margin-left: 20px;">
                <h5>Nama Penyewa : {{ $main->name }}</h5>
                <h5>Nama Alat : {{ $first->nama_nyewa }}</h5>
                <h5>Biaya : Rp. {{ number_format($first->biaya,0) }}</h5>
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
                <a href="{{ url("detail_penyewa_keuangan/$ids") }}" class="btn btn-warning mb-4">Kembali</a>
                <div class="row">
                    @foreach ($result as $row)   
                    <div class="col-md-6 mt-4">
                        <div class="card">
                            <div class="card-header">
                                <h5>Angsuran {{ $loop->iteration }}</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="d-flex" style="justify-content: center">
                                            <img src="{{ asset('assets/img/' . $row->img)}}" style="width: 300px;height:auto" alt="">
                                        </div>
                                    </li>
                                    <li class="list-group-item">Nominal : Rp. {{ number_format($row->nominal,0) }}</li>
                                    <li class="list-group-item">Dibuat : {{ date("d, F Y",strtotime($row->created_at)) }}</li>
                                    
                                    <li class="list-group-item">Pesan : {{ $row->pesan }}</li>
                                    <li class="list-group-item">
                                        <a href="{{ asset("assets/img/" . $row->img) }}" download class="btn btn-success">Download</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <script>
            $("#.tab").DataTables();
        </script>
    @endsection
