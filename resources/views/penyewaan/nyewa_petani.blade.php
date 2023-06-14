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
                        <table class="datatables-ajax table-hover table table-bordered" id="myTable">
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
                                        <td>{{ $da->nama_penyedia }}</td>
                                        <td>{{ $da->alat->nama }}</td>
                                        <td>Rp. {{ number_format($da->biaya, 0) }}</td>
                                        <td>{{ $row->lama_nyewa }} Hari</td>
                                        <td>
                                            @if ($row->status == 'aktif' || $row->status == 'selesai')
                                                <span
                                                    class="badge badge-pill badge-success bg-success">Sudah Di ACC</span>
                                            @elseif($row->status == 'belum aktif')
                                                <span
                                                    class="badge badge-pill badge-success bg-warning">Belum Di ACC</span>
                                            @elseif($row->status == 'tolak')
                                                <span
                                                    class="badge badge-pill badge-success bg-danger">Di Tolak</span>
                                            @endif
                                        </td>
                                        <td>{{ $row->unit_sewa }} Unit</td>
                                        <td>{{ date('d, F Y', strtotime($row->jatuh_tempo)) }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#detail{{ $row->id }}"><i class="fas fa-eye"></i></a>
                                            @if ($row->status == 'belum aktif')
                                                <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#edit{{ $row->id }}"><i
                                                        class="fas fa-pen"></i></a>
                                                <a href="#"
                                                    class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#delete{{ $row->id }}"><i class="fas fa-trash"></i></a>
                                                    <div class="modal fade" id="delete{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                          <div class="modal-content">
                                                            <div class="modal-header">
                                                              <h5 class="modal-title" id="exampleModalLabel">Hapus Penyewaan Alat</h5>
                                                              <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                              </button>
                                                            </div>
                                                            <div class="modal-body">
                                                              <h4>Apakah Anda Yakin Ingin Menghapus Data Ini?</h4>
                                                            </div>
                                                            <div class="modal-footer">
                                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                              <a href="{{ url("hapus_nyewa_detail/$row->id") }}" class="btn btn-danger">Iya</a>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
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
                                                                        <option value="1" {{ ($row->lama_nyewa == "1") ? "selected" : ""; }}>1 Hari</option>
                                                                        <option value="2" {{ ($row->lama_nyewa == "2") ? "selected" : ""; }}>2 Hari</option>
                                                                        <option value="3" {{ ($row->lama_nyewa == "3") ? "selected" : ""; }}>3 Hari</option>
                                                                        <option value="4" {{ ($row->lama_nyewa == "4") ? "selected" : ""; }}>4 Hari</option>
                                                                        <option value="5" {{ ($row->lama_nyewa == "5") ? "selected" : ""; }}>5 Hari</option>
                                                                        <option value="6" {{ ($row->lama_nyewa == "6") ? "selected" : ""; }}>6 Hari</option>
                                                                        <option value="7" {{ ($row->lama_nyewa == "7") ? "selected" : ""; }}>7 Hari</option>
                                                                        <option value="8" {{ ($row->lama_nyewa == "8") ? "selected" : ""; }}>8 Hari</option>
                                                                        <option value="9" {{ ($row->lama_nyewa == "9") ? "selected" : ""; }}>9 Hari</option>
                                                                        <option value="10" {{ ($row->lama_nyewa == "10") ? "selected" : ""; }}>10 Hari</option>
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
                                                            <h5 class="modal-title" id="modalFullTitle">Detail Penyewaan Alat</h5>
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
                                                                            {{ $da->nama_penyedia }}</li>
                                                                        <li class="list-group-item">Nama Alat :
                                                                            {{ $da->alat->nama }}</li>
                                                                        <li class="list-group-item">Luas Tanah:
                                                                            {{ $da->luas_tanah }}</li>
                                                                        <li class="list-group-item">Biaya :
                                                                            Rp.{{ number_format($da->biaya, 0) }}</li>
                                                                            <li class="list-group-item">Unit Sewa :
                                                                                {{ $row->unit_sewa }}</li>
                                                                        <li class="list-group-item">Jatuh Tempo :
                                                                            {{ date('d, F Y', strtotime($row->jatuh_tempo)) }}
                                                                        </li>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <li class="list-group-item">Status :
                                                                            @if ($row->status == 'aktif' || $row->status == 'selesai')
                                                <span
                                                    class="badge badge-pill badge-success bg-success">Sudah Di ACC</span>
                                            @elseif($row->status == 'belum aktif')
                                                <span
                                                    class="badge badge-pill badge-success bg-warning">Belum Di ACC</span>
                                            @elseif($row->status == 'tolak')
                                                <span
                                                    class="badge badge-pill badge-success bg-danger">Tolak</span>
                                            @endif
                                                                        </li>
                                                                        <li class="list-group-item">Lama Nyewa :
                                                                            {{ $row->lama_nyewa }} Hari</li>
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

                                                                @if ($row->pesan_tolak)
                                                                <li class="list-group-item">
                                                                    Pesan Tolak :
                                                                    {{$row->pesan_tolak}}
                                                                </li>
                                                               @endif
                                                            </ul>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-label-secondary"
                                                                data-bs-dismiss="modal">Close</button>
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
            });
        </script>
    @endsection
