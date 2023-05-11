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
                <a href="#" class="btn btn-primary mb-4"  data-bs-toggle="modal"
                data-bs-target="#edit">Tambah</a>
                <div class="modal fade" id="edit" tabindex="-1"
                    aria-hidden="true">
                    <div class="modal-dialog  modal-lg" role="document">
                        <form method="POST" enctype="multipart/form-data" class="modal-content"
                            action="{{ url('bayar_sekarang') }}">
                            <input type="hidden" name="id" value="{{ $id }}">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalFullTitle">Tambah Pembayaran</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                           <div class="modal-body">
                            <div class="mb-1">
                                <label for="">Nominal</label>
                                <input type="number" class="form-control" required placeholder="Nominal" name="nominal">
                            </div>
                            <br>  
                            <div class="mb-1">
                                <label for="">Bukti Foto</label>
                                <input type="file" class="form-control" required placeholder="foto" name="foto">
                            </div>
                            <br>  
                            <div class="mb-1">
                                <label for="">Pesan</label>
                                <textarea name="pesan" id="pesan" class="form-control" required placeholder="Pesan" cols="30" rows="10"></textarea>
                            </div>
                            <br>  
                           </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                <div class="row">
                    @foreach ($result as $row)   
                    <div class="col-md-6">
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
                                    <li class="list-group-item"></li>
                                    <li class="list-group-item"></li>
                                    <li class="list-group-item"></li>
                                    <li class="list-group-item"></li>
                                    <li class="list-group-item"></li>
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
