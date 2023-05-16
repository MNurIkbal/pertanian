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
                                    <th>Nama Penyewa</th>
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
                                        $da = App\Models\PenyewaanModel::where('id', $row->penyewaan_id)->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $da->nama_nyewa }}</td>
                                        <td>{{ $da->jenis }}</td>
                                        <td>Rp. {{ number_format($da->biaya, 0) }}</td>
                                        <td>{{ $row->lama_nyewa }}</td>
                                        <td>
                                            @if ($row->status == 'aktif' || $row->status == 'selesai')
                                                <span
                                                    class="badge badge-pill badge-success bg-success">{{ $row->status }}</span>
                                            @elseif($row->status == 'belum aktif')
                                                <span
                                                    class="badge badge-pill badge-success bg-danger">{{ $row->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $row->unit_sewa }} Unit</td>
                                        <td>{{ date('d, F Y', strtotime($da->expired)) }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#detail{{ $row->id }}"><i class="fas fa-eye"></i></a>
                                            @if ($row->status == 'belum aktif')
                                                <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#edit{{ $row->id }}"><i
                                                        class="fas fa-pen"></i></a>
                                                <a href="{{ url("hapus_nyewa_detail/$row->id") }}"
                                                    class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                    <div class="modal fade" id="edit{{ $row->id }}" tabindex="-1"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog  modal-lg" role="document">
                                                            <form method="POST" enctype="multipart/form-data" class="modal-content"
                                                                action="{{ url('edit_pesan_sekarang') }}">
                                                                <input type="hidden" name="id" value="{{ $row->id }}">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalFullTitle">Edit Alat</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                   <div class="mb-1">
                                                                    <label for="">Lama Nyewa</label>
                                                                    <select name="lama_nyewa" id="" class="form-control" required>
                                                                        <option value="">Pilih</option>
                                                                        <option value="1 Bulan" {{ ($row->lama_nyewa == "1 Bulan") ? "selected" : ""; }}>1 Bulan</option>
                                                                        <option value="3 Bulan" {{ ($row->lama_nyewa == "3 Bulan") ? "selected" : ""; }}>3 Bulan</option>
                                                                        <option value="6 Bulan" {{ ($row->lama_nyewa == "6 Bulan") ? "selected" : ""; }}>6 Bulan</option>
                                                                        <option value="1 Tahun" {{ ($row->lama_nyewa == "1 Tahun") ? "selected" : ""; }}>1 Tahun</option>
                                                                        <option value="2 Tahun" {{ ($row->lama_nyewa == "2 Tahun") ? "selected" : ""; }}>2 Tahun</option>
                                                                        <option value="3 Tahun" {{ ($row->lama_nyewa == "3 Tahun") ? "selected" : ""; }}>3 Tahun</option>
                                                                        <option value="4 Tahun" {{ ($row->lama_nyewa == "4 Tahun") ? "selected" : ""; }}>4 Tahun</option>
                                                                        <option value="5 Tahun" {{ ($row->lama_nyewa == "5 Tahun") ? "selected" : ""; }}>5 Tahun</option>
                                                                    </select>
                                                                   </div>
                                                                   <br>
                                                                   <div class="mb-1">
                                                                    <label for="">Alamat</label>
                                                                    <textarea name="alamat" id="" class="form-control" required cols="30" rows="5">{{ $row->alamat }}</textarea>
                                                                   </div>
                                                                   <br>
                                                                   <div class="mb-1">
                                                                    <label for="">No Hp</label>
                                                                    <input type="number" class="form-control" value="{{ $row->no_hp }}" name="no_hp" required>
                                                                   </div>
                                                                   <br>
                                                                   <div class="mb-1">
                                                                    <label for="">Unit Yang Di Sewa</label>
                                                                    <select name="unit_sewa" class="form-control " required  id="">
                                                                        <option value="">Pilih</option>
                                                                        <option value="1" {{ ($row->unit_sewa == "1") ? "selected" : ""; }}>1 Unit</option>
                                                                        <option value="2" {{ ($row->unit_sewa == "2") ? "selected" : ""; }}>2 Unit</option>
                                                                        <option value="3" {{ ($row->unit_sewa == "3") ? "selected" : ""; }}>3 Unit</option>
                                                                        <option value="1" {{ ($row->unit_sewa == "4") ? "selected" : ""; }}>4 Unit</option>
                                                                        <option value="5" {{ ($row->unit_sewa == "5") ? "selected" : ""; }}>5 Unit</option>
                                                                        <option value="6" {{ ($row->unit_sewa == "6") ? "selected" : ""; }}>6 Unit</option>
                                                                        <option value="7" {{ ($row->unit_sewa == "7") ? "selected" : ""; }}>7 Unit</option>
                                                                        <option value="8" {{ ($row->unit_sewa == "8") ? "selected" : ""; }}>8 Unit</option>
                                                                        <option value="9" {{ ($row->unit_sewa == "9") ? "selected" : ""; }}>9 Unit</option>
                                                                        <option value="10" {{ ($row->unit_sewa == "10") ? "selected" : ""; }}>10 Unit</option>
                                                                    </select>
                                                                   </div>
                                                                   <br>
                                                                   <div class="alert alert-warning">
                                                                    <p>
                                                                        Persiapkan terlebih dahulu untuk melakukan pemesanan.
                                                                    </p>
                                                                   </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-label-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                            @endif


                                            <div class="modal fade" id="detail{{ $row->id }}" tabindex="-1"
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
                                                                    <div class="d-flex" style="justify-content: center">
                                                                        <img src="{{ asset('assets/img/' . $da->img) }}"
                                                                            style="width:300px;height:auto" alt="">
                                                                    </div>
                                                                </li>
                                                                <div class="row mt-4">
                                                                    <div class="col-md-6">
                                                                        <li class="list-group-item">Nama Penyewa :
                                                                            {{ $da->nama_nyewa }}</li>
                                                                        <li class="list-group-item">Nama Alat :
                                                                            {{ $da->jenis }}</li>
                                                                        <li class="list-group-item">Luas Tanah:
                                                                            {{ $da->satuan }}</li>
                                                                        <li class="list-group-item">Tanggal Sewa :
                                                                            {{ date('d, F Y', strtotime($da->expired)) }}
                                                                        </li>
                                                                        <li class="list-group-item">Biaya :
                                                                            Rp.{{ number_format($da->biaya, 0) }}</li>
                                                                        <li class="list-group-item">Jatuh Tempo :
                                                                            {{ date('d, F Y', strtotime($row->jatuh_tempo)) }}
                                                                        </li>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <li class="list-group-item">Unit Sewa :
                                                                            {{ $row->unit_sewa }}</li>
                                                                        <li class="list-group-item">Status :
                                                                            {{ $row->status }}
                                                                        </li>
                                                                        <li class="list-group-item">Lama Nyewa :
                                                                            Rp.{{ $row->lama_nyewa }}</li>
                                                                        <li class="list-group-item">Dibuat :
                                                                            {{ $row->created_at }}
                                                                        </li>
                                                                        <li class="list-group-item">No Hp :
                                                                            {{ $row->no_hp }}
                                                                        </li>
                                                                        <li class="list-group-item">Alamat :
                                                                            {{ $row->alamat }}
                                                                        </li>
                                                                        <li class="list-group-item">Pesan :
                                                                            {{ $da->pesan }}
                                                                        </li>
                                                                    </div>
                                                                </div>
                                                            </ul>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-label-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            {{-- <a href="{{ url("hapus_nyewa/$row->id") }}" class="btn btn-primary">Hapus</a> --}}
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
