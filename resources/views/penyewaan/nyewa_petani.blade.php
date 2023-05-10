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
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
                <div class="modal fade" id="tambah" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog  modal-lg" role="document">
                        <form method="POST" enctype="multipart/form-data" class="modal-content"
                            action="{{ url('tambah_nyewa') }}">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalFullTitle">Tambah Alat</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="containers">
                                    <div class="row">
                                        <div class="col-md-6">
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
                                                    <h5>Jenis*</h5>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text"
                                                        class="form-control @error('jenis')
                                is-invalid
                            @enderror"
                                                        placeholder="Jenis" name="jenis" required />
                                                </div>
                                                @error('jenis')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <br>
                                            <div class="mb-1">
                                                <label for="" style="margin-bottom: 5px !important;">
                                                    <h5>Satuan*</h5>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text"
                                                        class="form-control @error('satuan')
                                is-invalid
                            @enderror"
                                                        placeholder="Satuan" name="satuan" required />
                                                </div>
                                                @error('satuan')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <br>
                                            <div class="mb-1">
                                                <label for="" style="margin-bottom: 5px !important;">
                                                    <h5>Unit*</h5>
                                                </label>
                                                <div class="input-group">
                                                    <input type="number"
                                                        class="form-control @error('unit')
                                is-invalid
                            @enderror"
                                                        placeholder="Unit" name="unit" required />
                                                </div>
                                                @error('unit')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <br>
                                            <div class="mb-1">
                                                <label for="" style="margin-bottom: 5px !important;">
                                                    <h5>Biaya*</h5>
                                                </label>
                                                <div class="input-group">
                                                    <input type="number"
                                                        class="form-control @error('biaya')
                                is-invalid
                            @enderror"
                                                        placeholder="Biaya" name="biaya" required />
                                                </div>
                                                @error('biaya')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <label for="" style="margin-bottom: 5px !important;">
                                                    <h5>Expired*</h5>
                                                </label>
                                                <div class="input-group">
                                                    <input type="date"
                                                        class="form-control @error('expired')
                                is-invalid
                            @enderror"
                                                        placeholder="Expired" name="expired" required />
                                                </div>
                                                @error('expired')
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
                                                        class="form-control @error('foto')
                                is-invalid
                            @enderror"
                                                        placeholder="foto" name="foto" required />
                                                </div>
                                                @error('foto')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <br>
                                            <div class="mb-1">
                                                <label for="" style="margin-bottom: 5px !important;">
                                                    <h5>Pesan*</h5>
                                                </label>
                                                <div class="input-group">
                                                    <textarea
                                                        class="form-control @error('pesan')
                                is-invalid
                            @enderror"
                                                        placeholder="Pesan" name="pesan" required rows="5" cols="30"></textarea>
                                                </div>
                                                @error('pesan')
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
                    <table class="datatables-ajax table table-bordered" id="tab">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Alat</th>
                                <th>Jenis</th>
                                <th>Satuan</th>
                                <th>Biaya</th>
                                <th>Expired</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($result->penyewaan as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('assets/img/' . $row->img) }}"
                                            style="width: 70px;height: 70px;" alt="">
                                    </td>
                                    <td>{{ $row->nama_nyewa }}</td>
                                    <td>{{ $row->jenis }}</td>
                                    <td>{{ $row->satuan }}</td>
                                    <td>Rp. {{ number_format($row->biaya, 0) }} Perbulan</td>
                                    <td>{{ $row->unit }} Unit</td>
                                    <td>{{ date('d, F Y', strtotime($row->expired)) }}</td>
                                    <td>
                                        <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $row->id }}"><i class="fas fa-pen"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#hapus{{ $row->id }}"><i class="fas fa-trash"></i></a>
                                        <div class="modal fade" id="edit{{ $row->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog  modal-lg" role="document">
                                                <form method="POST" enctype="multipart/form-data" class="modal-content"
                                                    action="{{ url('edit_nyewa') }}">
                                                    <input type="hidden" name="id" value="{{ $row->id }}">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalFullTitle">Edit Alat</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="containers">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-1">
                                                                        <label for=""
                                                                            style="margin-bottom: 5px !important;">
                                                                            <h5>Nama Alat*</h5>
                                                                        </label>
                                                                        <div class="input-group">
                                                                            <input type="text"
                                                                                value="{{ $row->nama_nyewa }}"
                                                                                class="form-control @error('nama_alat')
                                              is-invalid
                                          @enderror"
                                                                                placeholder="Nama Alat" name="nama_alat"
                                                                                required />
                                                                        </div>
                                                                        @error('nama_alat')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                    <br>
                                                                    <div class="mb-1">
                                                                        <label for=""
                                                                            style="margin-bottom: 5px !important;">
                                                                            <h5>Jenis*</h5>
                                                                        </label>
                                                                        <div class="input-group">
                                                                            <input type="text"
                                                                                value="{{ $row->jenis }}"
                                                                                class="form-control @error('jenis')
                                              is-invalid
                                          @enderror"
                                                                                placeholder="Jenis" name="jenis"
                                                                                required />
                                                                        </div>
                                                                        @error('jenis')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                    <br>
                                                                    <div class="mb-1">
                                                                        <label for=""
                                                                            style="margin-bottom: 5px !important;">
                                                                            <h5>Satuan*</h5>
                                                                        </label>
                                                                        <div class="input-group">
                                                                            <input type="text"
                                                                                value="{{ $row->satuan }}"
                                                                                class="form-control @error('satuan')
                                              is-invalid
                                          @enderror"
                                                                                placeholder="Satuan" name="satuan"
                                                                                required />
                                                                        </div>
                                                                        @error('satuan')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                    <br>
                                            <div class="mb-1">
                                                <label for="" style="margin-bottom: 5px !important;">
                                                    <h5>Unit*</h5>
                                                </label>
                                                <div class="input-group">
                                                    <input type="number" value="{{ $row->unit }}"
                                                        class="form-control @error('unit')
                                is-invalid
                            @enderror"
                                                        placeholder="Unit" name="unit" required />
                                                </div>
                                                @error('unit')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                                                    <br>
                                                                    <div class="mb-1">
                                                                        <label for=""
                                                                            style="margin-bottom: 5px !important;">
                                                                            <h5>Biaya*</h5>
                                                                        </label>
                                                                        <div class="input-group">
                                                                            <input type="number"
                                                                                value="{{ $row->biaya }}"
                                                                                class="form-control @error('biaya')
                                              is-invalid
                                          @enderror"
                                                                                placeholder="Biaya" name="biaya"
                                                                                required />
                                                                        </div>
                                                                        @error('biaya')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-1">
                                                                        <label for=""
                                                                            style="margin-bottom: 5px !important;">
                                                                            <h5>Expired*</h5>
                                                                        </label>
                                                                        <div class="input-group">
                                                                            <input type="date"
                                                                                value="{{ $row->expired }}"
                                                                                class="form-control @error('expired')
                                              is-invalid
                                          @enderror"
                                                                                placeholder="Expired" name="expired"
                                                                                required />
                                                                        </div>
                                                                        @error('expired')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                    <br>
                                                                    <div class="mb-1">
                                                                        <label for=""
                                                                            style="margin-bottom: 5px !important;">
                                                                            <h5>Foto*</h5>
                                                                        </label>
                                                                        <div class="input-group">
                                                                            <input type="file"
                                                                                class="form-control @error('foto')
                                              is-invalid
                                          @enderror"
                                                                                placeholder="foto" name="foto" />
                                                                        </div>
                                                                        @error('foto')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                        <input type="hidden" name="foto_lama"
                                                                            value="{{ $row->img }}">
                                                                    </div>
                                                                    <br>
                                                                    <div class="mb-1">
                                                                        <label for=""
                                                                            style="margin-bottom: 5px !important;">
                                                                            <h5>Pesan</h5>
                                                                        </label>
                                                                        <div class="input-group">
                                                                            <textarea
                                                                                class="form-control @error('pesan')
                                              is-invalid
                                          @enderror"
                                                                                placeholder="Pesan" name="pesan" required rows="5" cols="30">{{ $row->pesan }}</textarea>
                                                                        </div>
                                                                        @error('pesan')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
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
                                        <div class="modal fade" id="hapus{{ $row->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog  modal-lg" role="document">
                                                <form method="POST" enctype="multipart/form-data" class="modal-content"
                                                    action="{{ url('edit_nyewa') }}">
                                                    <input type="hidden" name="id" value="{{ $row->id }}">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalFullTitle">Hapus Alat</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                       <h4>Apakah Anda Yakin Ingin Menghapus!</h4>
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
        <script>
            $("#.tab").DataTables();
        </script>
    @endsection
