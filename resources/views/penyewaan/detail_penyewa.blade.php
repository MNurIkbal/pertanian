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
            <h5 class="card-header">Detail Penyewaan Alat</h5>
            <h5 style="margin-left: 20px;">Nama Penyedia : {{ $hasil->nama_penyedia }}</h5>
            <h5 style="margin-left: 20px;">Nama Alat: {{ $hasil->alat->nama }}</h5>
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
                    <div class="table-responsive" style="overflow-x: scroll">
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
                                            @if ($row->status == "aktif" || $row->status == "selesai")
                                                
                                            <a href="{{ url('detail_pembayaran/' . $row->id)  }}" class="btn btn-sm btn-primary   "><i class="fas fa-clipboard"></i></a>
                                            @elseif($row->status == "belum aktif")
                                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#tolak{{ $row->id }}"><i class="fas fa-times"></i></a>
                                            <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#edit{{ $row->id }}"><i class="fas fa-check"></i></a>
                                            <div class="modal fade" id="tolak{{ $row->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog  modal-lg" role="document">
                                                    <form method="POST" enctype="multipart/form-data" class="modal-content"
                                                        action="{{ url("tolak_approve/$row->id") }}">
                                                        <input type="hidden" name="id" value="{{ $row->id }}">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalFullTitle">Tolak Persetujuan Penyewaan Alat</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                       <div class="modal-body">
                                                        <div class="mb-1">
                                                            <label for="">Pesan</label>
                                                            <textarea name="pesan" id="" class="form-control" required cols="30" rows="10"></textarea>
                                                        </div>
                                                       </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="edit{{ $row->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog  modal-lg" role="document">
                                                    <form method="POST" enctype="multipart/form-data" class="modal-content"
                                                        action="{{ url('approve') }}">
                                                        <input type="hidden" name="id" value="{{ $row->id }}">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalFullTitle">Menyetujuai Persetujuan Penyewaan Alat</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                       <div class="modal-body">
                                                        <h5>Apakah Anda Yakin Ingin ACC Alat Ini!</h5>
                                                       </div>
                                                        <div class="modal-footer">
                                                            {{-- <a href="{{ url("tolak_approve/$row->id") }}" class="btn btn-danger">Tolak</a> --}}
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
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
            });
        </script>
    @endsection
