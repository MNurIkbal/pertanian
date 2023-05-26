@extends('layouts.main2')

@section('title')
    Dashboard
@endsection

@section('dashboard')
    active
@endsection

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.css"/>

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <h5 class="card-header">Alat</h5>
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
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
                <div class="modal fade" id="tambah" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog  modal-lg" role="document">
                        <form method="POST" enctype="multipart/form-data" class="modal-content"
                            action="{{ url('tambah_alat') }}">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalFullTitle">Tambah Alat</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="containers">
                                    <div>
                                        <div>
                                            <div class="mb-1">
                                                <label for="" style="margin-bottom: 5px !important;">
                                                    <h5>Kode*</h5>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text"
                                                        class="form-control @error('kode')
                                is-invalid
                            @enderror"
                                                        placeholder="Kode" name="kode" required />
                                                </div>
                                                @error('kode')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <br>
                                            <div class="mb-1">
                                                <label for="" style="margin-bottom: 5px !important;">
                                                    <h5>Nama Alat*</h5>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text"
                                                        class="form-control @error('nama_alat')
                                is-invalid
                            @enderror"
                                                        placeholder="Nama Alat" name="nama_alat" required />
                                                </div>
                                                @error('nama_alat')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <br>
                                            <div class="mb-1">
                                                <label for="" style="margin-bottom: 5px !important;">
                                                    <h5>Foto*</h5>
                                                </label>
                                                <div class="input-group">
                                                    <input type="file"
                                                        class="form-control @error('file')
                                is-invalid
                            @enderror"
                                                        placeholder="Luas Tanah" name="file" required />
                                                </div>
                                                @error('file')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <br>
                                            <div class="mb-1">
                                                <label for="" style="margin-bottom: 5px !important;">
                                                    <h5>Status*</h5>
                                                </label>
                                                <div class="input-group">
                                                    <select name="status" id="status" class="form-control @error('status')
                                                        is-invalid
                                                    @enderror">
                                                <option value="">Pilih</option>
                                                <option value="1">Aktif</option>
                                                <option value="0">Tidak Aktif</option>
                                            </select>
                                                </div>
                                                @error('unit')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
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
                <div class="card-datatable text-nowrap">
                    <div class="table-responsive" >
                        <table class="datatables-ajax table table-bordered display" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Nama Alat</th>
                                    <th>Dibuat</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div>
                                            <img src="{{ asset('assets/img/' . $row->img) }}" style="width: 100px;height: auto" alt="">
                                        </div>
                                    </td>
                                    <td>{{ $row->nama }}</td>
                                    <td>{{ date("d, F Y",strtotime($row->created_at)) }}</td>
                                    <td>
                                        @if ($row->active == "1")
                                            <span class="badge badge-pill badge-success bg-success">Aktif</span>
                                            @else
                                            <span class="badge badge-pill badge-danger bg-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#edit{{ $row->id }}"><i class="fas fa-pen"></i></a>
                                        <div class="modal fade" id="edit{{ $row->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog  modal-lg" role="document">
                                                <form method="POST" enctype="multipart/form-data" class="modal-content"
                                                    action="{{ url('edit_alat') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $row->id }}">
                                                    <input type="hidden" name="img_lama" value="{{ $row->img }}">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalFullTitle">Edit Alat</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="containers">
                                                            <div>
                                                                <div>
                                                                    <div class="mb-1">
                                                                        <label for="" style="margin-bottom: 5px !important;">
                                                                            <h5>Kode*</h5>
                                                                        </label>
                                                                        <div class="input-group">
                                                                            <input type="text"
                                                                                class="form-control @error('kode')
                                                        is-invalid
                                                    @enderror"
                                                                                placeholder="Kode" value="{{ $row->kode }}" name="kode" required />
                                                                        </div>
                                                                        @error('kode')
                                                                            <small class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                    <br>
                                                                    <div class="mb-1">
                                                                        <label for="" style="margin-bottom: 5px !important;">
                                                                            <h5>Nama Alat*</h5>
                                                                        </label>
                                                                        <div class="input-group">
                                                                            <input type="text"
                                                                                class="form-control @error('nama_alat')
                                                        is-invalid
                                                    @enderror"
                                                                                placeholder="Nama Alat" value="{{ $row->nama }}" name="nama_alat" required />
                                                                        </div>
                                                                        @error('nama_alat')
                                                                            <small class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                    <br>
                                                                    <div class="mb-1">
                                                                        <label for="" style="margin-bottom: 5px !important;">
                                                                            <h5>Foto*</h5>
                                                                        </label>
                                                                        <div class="input-group">
                                                                            <input type="file"
                                                                                class="form-control @error('file')
                                                        is-invalid
                                                    @enderror"
                                                                                placeholder="Luas Tanah" name="file"  />
                                                                        </div>
                                                                        @error('file')
                                                                            <small class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                  <br>
                                                                    <div class="mb-1">
                                                                        <label for="" style="margin-bottom: 5px !important;">
                                                                            <h5>Status*</h5>
                                                                        </label>
                                                                        <div class="input-group">
                                                                            <select name="status" id="status" class="form-control @error('status')
                                                                                is-invalid
                                                                            @enderror">
                                                                        <option value="">Pilih</option>
                                                                        <option value="1" {{ ($row->active == "1") ? "selected" : ""; }}>Aktif</option>
                                                                        <option value="0" {{ ($row->active == "0") ? "selected" : ""; }}>Tidak Aktif</option>
                                                                    </select>
                                                                        </div>
                                                                        @error('status')
                                                                            <small class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
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

                                        <a href="#" class="btn btn-danger btn-sm"  data-bs-toggle="modal" data-bs-target="#hapus{{ $row->id }}"><i class="fas fa-trash"></i></a>
                                        <div class="modal fade" id="hapus{{ $row->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog  modal-lg" role="document">
                                                <form method="POST" enctype="multipart/form-data" class="modal-content"
                                                    action="{{ url('hapus_alat') }}">
                                                    @csrf
                                                    @method("DELETE")
                                                    <input type="hidden" name="id" value="{{ $row->id }}">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalFullTitle">Hapus Alat</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4>Apakah Anda Ingin Menghapus Data Ini?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-label-secondary"
                                                            data-bs-dismiss="modal">Tidak</button>
                                                        <button type="submit" class="btn btn-primary">Iya</button>
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
