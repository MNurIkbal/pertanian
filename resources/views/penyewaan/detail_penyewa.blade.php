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
            <h5 class="card-header">Detail Penyewaan Alat</h5>
            <h5 style="margin-left: 20px;">Nama Penyewa : {{ $hasil->nama_nyewa }}</h5>
            <h5 style="margin-left: 20px;">Nama Alat: {{ $hasil->jenis }}</h5>
            <h5 style="margin-left: 20px;">Biaya : Rp. {{ number_format($hasil->biaya,0) }}</h5>
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
                <a href="{{ url("penyewaan") }}" class="btn btn-warning mb-4">Kembali</a>
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
                                        @if ($row->status == "aktif")
                                            
                                        <a href="#" class="btn btn-sm btn-primary   "><i class="fas fa-check"></i></a>
                                        @elseif($row->status == "belum aktif")
                                        <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $row->id }}"><i class="fas fa-pen"></i></a>
                                        <div class="modal fade" id="edit{{ $row->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog  modal-lg" role="document">
                                                <form method="POST" enctype="multipart/form-data" class="modal-content"
                                                    action="{{ url('approve') }}">
                                                    <input type="hidden" name="id" value="{{ $row->id }}">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalFullTitle">Persetujuan Penyewaan Alat</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                   <div class="modal-body">
                                                    <h5>Apakah Anda Yakin Ingin Menyewakan Alat Ini!</h5>
                                                   </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ url("tolak_approve/$row->id") }}" class="btn btn-danger">Tolak</a>
                                                        <button type="submit" class="btn btn-primary">Iya</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @else
                                        <a href="#" class="btn btn-sm btn-primary   "><i class="fa-solid fa-xmark"></i></a>
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
