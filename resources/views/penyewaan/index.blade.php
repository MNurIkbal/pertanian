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
                                                    <h5>Nama Penyewa*</h5>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text"
                                                        class="form-control @error('nama_penyewa')
                                is-invalid
                            @enderror"
                                                        placeholder="Nama Penyewa" name="nama_penyewa" required />
                                                </div>
                                                @error('nama_penyewa')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <br>
                                            <div class="mb-1">
                                                <label for="" style="margin-bottom: 5px !important;">
                                                    <h5>Nama Alat*</h5>
                                                </label>
                                                <div class="input-group">
                                                    <select name="nama_alat" class="form-control" required id="">
                                                        <option value="">Pilih</option>
                                                        <option value="Mesin Panen">Mesin Panen</option>
                                                        <option value="Mesin Tanam">Mesin Tanam</option>
                                                        <option value="Mesin Traktor">Mesin Traktor</option>
                                                        <option value="Mesin Rmu Selepan">Mesin Rmu Selepan</option>
                                                    </select>
                                                </div>
                                                @error('jenis')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <br>
                                            <div class="mb-1">
                                                <label for="" style="margin-bottom: 5px !important;">
                                                    <h5>Luas Tanah*</h5>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text"
                                                        class="form-control @error('tanah')
                                is-invalid
                            @enderror"
                                                        placeholder="Luas Tanah" name="tanah" required />
                                                </div>
                                                @error('tanah')
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
                                                    <input type="text"
                                                        class="form-control @error('biaya')
                                is-invalid
                            @enderror"
                                                        placeholder="Biaya" name="biaya" id="rupiah" required />
                                                </div>
                                                @error('biaya')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <script>
                                            var rupiah = document.getElementById('rupiah');
                                            
                                            rupiah.addEventListener('keyup', function(e) {
                                                // tambahkan 'Rp.' pada saat form di ketik
                                                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                                                rupiah.value = formatRupiah(this.value, 'Rp. ');
                                            });

                                            /* Fungsi formatRupiah */
                                            function formatRupiah(angka, prefix) {
                                                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                                                    split = number_string.split(','),
                                                    sisa = split[0].length % 3,
                                                    rupiah = split[0].substr(0, sisa),
                                                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                                                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                                if (ribuan) {
                                                    separator = sisa ? '.' : '';
                                                    rupiah += separator + ribuan.join('.');
                                                }

                                                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                                                return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
                                            }
                                        </script>
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <label for="" style="margin-bottom: 5px !important;">
                                                    <h5>Tanggal Sewa*</h5>
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
                                                    <h5>Alamat Lengkap*</h5>
                                                </label>
                                                <div class="input-group">
                                                    <textarea
                                                        class="form-control @error('alamat')
                                is-invalid
                            @enderror"
                                                        placeholder="Alamat" name="alamat" required rows="5" cols="30"></textarea>
                                                </div>
                                                @error('alamat')
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
                    <div class="table-responsive" style="overflow-x: scroll">
                        <table class="datatables-ajax table table-bordered" id="tab">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Nama Penyewa</th>
                                    <th>Nama Alat</th>
                                    <th>Luas Tanah</th>
                                    <th>Biaya</th>
                                    <th>Unit</th>
                                    <th>Tanggal Sewa</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $row)
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
                                            <a href="{{ url("detail_penyewa/$row->id") }}"
                                                class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#edit{{ $row->id }}"><i class="fas fa-pen"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#hapus{{ $row->id }}"><i
                                                    class="fas fa-trash"></i></a>
                                            <div class="modal fade" id="edit{{ $row->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog  modal-lg" role="document">
                                                    <form method="POST" enctype="multipart/form-data"
                                                        class="modal-content" action="{{ url('edit_nyewa') }}">
                                                        <input type="hidden" name="id"
                                                            value="{{ $row->id }}">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalFullTitle">Edit Alat</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="containers">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="mb-1">
                                                                            <label for=""
                                                                                style="margin-bottom: 5px !important;">
                                                                                <h5>Nama Penyewa*</h5>
                                                                            </label>
                                                                            <div class="input-group">
                                                                                <input type="text"
                                                                                    value="{{ $row->nama_nyewa }}"
                                                                                    class="form-control @error('nama_alat')
                                                  is-invalid
                                              @enderror"
                                                                                    placeholder="Nama Penyewa"
                                                                                    name="nama_alat" required />
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
                                                                                <h5>Nama Alat*</h5>
                                                                            </label>
                                                                            <div class="input-group">
                                                                                <input type="text"
                                                                                    value="{{ $row->jenis }}"
                                                                                    class="form-control @error('jenis')
                                                  is-invalid
                                              @enderror"
                                                                                    placeholder="Nama Alat" name="jenis"
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
                                                                                <h5>Luas Tanah*</h5>
                                                                            </label>
                                                                            <div class="input-group">
                                                                                <input type="text"
                                                                                    value="{{ $row->satuan }}"
                                                                                    class="form-control @error('satuan')
                                                  is-invalid
                                              @enderror"
                                                                                    placeholder="Luas Tanah"
                                                                                    name="satuan" required />
                                                                            </div>
                                                                            @error('satuan')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <br>
                                                                        <div class="mb-1">
                                                                            <label for=""
                                                                                style="margin-bottom: 5px !important;">
                                                                                <h5>Unit*</h5>
                                                                            </label>
                                                                            <div class="input-group">
                                                                                <input type="number"
                                                                                    value="{{ $row->unit }}"
                                                                                    class="form-control @error('unit')
                                    is-invalid
                                @enderror"
                                                                                    placeholder="Unit" name="unit"
                                                                                    required />
                                                                            </div>
                                                                            @error('unit')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <br>
                                                                        <div class="mb-1">
                                                                            <label for=""
                                                                                style="margin-bottom: 5px !important;">
                                                                                <h5>Biaya*</h5>
                                                                            </label>
                                                                            <div class="input-group">
                                                                                <input type="text"
                                                                                    value="{{ $row->biaya }}"
                                                                                    class="form-control @error('biaya')
                                                  is-invalid
                                              @enderror"
                                                                                    placeholder="Biaya" name="biaya" id="biaya{{ $row->id }}"
                                                                                    required />
                                                                            </div>
                                                                            @error('biaya')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <script>
                                                                        var id = {{ $row->id}}
                                                                        var rupiahs{{$row->id}}  = document.getElementById('biaya' + id);
                                                                        
                                                                        rupiahs{{ $row->id }}.addEventListener('keyup', function(e) {
                                                                            // tambahkan 'Rp.' pada saat form di ketik
                                                                            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                                                                            rupiahs{{$row->id}}.value = formatRupiahs{{$row->id}}(this.value, 'Rp. ');
                                                                        });
                            
                                                                        /* Fungsi formatRupiah */
                                                                        function formatRupiahs{{$row->id}}(angka, prefix) {
                                                                            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                                                                                split = number_string.split(','),
                                                                                sisa = split[0].length % 3,
                                                                                rupiahs{{$row->id}} = split[0].substr(0, sisa),
                                                                                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                            
                                                                            // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                                                            if (ribuan) {
                                                                                separator = sisa ? '.' : '';
                                                                                rupiahs{{$row->id}} += separator + ribuan.join('.');
                                                                            }
                            
                                                                            rupiahs{{$row->id}} = split[1] != undefined ? rupiahs{{$row->id}} + ',' + split[1] : rupiahs{{$row->id}};
                                                                            return prefix == undefined ? rupiahs{{$row->id}} : (rupiahs{{$row->id}} ? '' + rupiahs{{$row->id}} : '');
                                                                        }
                                                                    </script>
                                                                    <div class="col-md-6">
                                                                        <div class="mb-1">
                                                                            <label for=""
                                                                                style="margin-bottom: 5px !important;">
                                                                                <h5>Tanggal Sewa*</h5>
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
                                                                                <h5>Alamat Lengkap</h5>
                                                                            </label>
                                                                            <div class="input-group">
                                                                                <textarea
                                                                                    class="form-control @error('pesan')
                                                  is-invalid
                                              @enderror"
                                                                                    placeholder="Alamat Lengkap" name="pesan" required rows="5" cols="30">{{ $row->pesan }}</textarea>
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
                                                    <form method="POST" enctype="multipart/form-data"
                                                        class="modal-content" action="{{ url('edit_nyewa') }}">
                                                        <input type="hidden" name="id"
                                                            value="{{ $row->id }}">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalFullTitle">Hapus Alat</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h4>Apakah Anda Yakin Ingin Menghapus!</h4>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-label-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <a href="{{ url("hapus_nyewa/$row->id") }}"
                                                                class="btn btn-primary">Hapus</a>
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
