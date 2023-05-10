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
            <h5 class="card-header">Penyewaan Alat</h5>
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
                <a class="btn btn-primary mb-3" href="{{ url('tambah_data_nyewa') }}">Tambah</a>
                <div class="card-datatable text-nowrap">
                    <div class="table-responsive">
                        <table class="datatables-ajax table-hover table table-bordered" id="tab">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Nama Alat</th>
                                    <th>Biaya</th>
                                    <th>Lama Nyewa</th>
                                    <th>Status</th>
                                    <th>Banyak Unit</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $row)
                                @php
                                    $da = App\Models\PenyewaanModel::where("id",$row->penyewaan_id)->first();
                                @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ asset('assets/img/' . $da->img) }}"
                                                style="width: 70px;height: 70px;" alt="">
                                        </td>
                                        <td>{{ $da->nama_nyewa }}</td>
                                        <td>Rp. {{ number_format($da->biaya, 0) }}</td>
                                        <td>{{ $row->lama_nyewa }}</td>
                                        <td>
                                            @if ($row->status == "aktif")
                                            <span class="badge badge-pill badge-success bg-success">{{ $row->status }}</span>
                                            @else
                                            <span class="badge badge-pill badge-success bg-danger">{{ $row->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $da->unit }} Unit</td>
                                        <td>{{ date('d, F Y', strtotime($da->expired)) }}</td>
                                        <td>
                                            <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#detail{{ $da->id }}"><i class="fas fa-eye"></i></a>
                                                @if ($row->status == "belum aktif")
                                                <a href="{{ url("hapus_nyewa_detail/$row->id") }}" class="btn btn-danger btn-sm" ><i class="fas fa-trash"></i></a>
                                                @endif
                                            
                                            <div class="modal fade" id="detail{{ $da->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog  modal-lg" role="document">
                                                    <form method="POST" enctype="multipart/form-data" class="modal-content"
                                                        action="{{ url('edit_nyewa') }}">
                                                        <input type="hidden" name="id" value="{{ $row->id }}">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalFullTitle">Detail Alat</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                           <ul class="list-group">
                                                            <li class="list-group-item">
                                                                <img src="{{ asset("assets/img/" . $da->img) }}" style="width:300px;height:auto" alt="">
                                                            </li>
                                                            <li class="list-group-item">Nama Alat : {{ $da->nama_nyewa }}</li>
                                                            <li class="list-group-item">Jenis : {{ $da->jenis }}</li>
                                                            <li class="list-group-item">Satuan : {{ $da->satuan }}</li>
                                                            <li class="list-group-item">Expired : {{ date("d, F Y",strtotime($da->expired)) }}</li>
                                                            <li class="list-group-item">Biaya : Rp.{{ number_format($da->biaya,0) }}</li>
                                                            <li class="list-group-item">Jatuh Tempo : {{ date("d, F Y",strtotime($row->jatuh_tempo)) }}</li>
                                                            <li class="list-group-item">Unit Sewa : {{ $row->unit_sewa }}</li>
                                                            <li class="list-group-item">Status : {{ $row->status }}</li>
                                                            <li class="list-group-item">Lama Nyewa : Rp.{{ $row->lama_nyewa }}</li>
                                                            <li class="list-group-item">Dibuat : {{ $row->created_at     }}</li>
                                                            <li class="list-group-item">No Hp : {{ $row->no_hp     }}</li>
                                                            <li class="list-group-item">Alamat : {{ $row->alamat     }}</li>
                                                            <li class="list-group-item">Pesan : {{ $da->pesan }}</li>
                                                           </ul>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-label-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <a href="{{ url("hapus_nyewa/$row->id") }}" class="btn btn-primary">Hapus</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
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
