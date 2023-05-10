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
            <h5 class="card-header">Tambah Penyewaan Alat</h5>
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
                <a href="{{ url('nyewa_petani') }}" style="margin-top: -15px;" class="btn btn-warning">Kembali</a>
                <div class="row">
                    @foreach ($result as $row)
                    <div class="col-md-6">
                        <div class="card mt-5">
                            <div class="card-header">
                                <h5 class="card-title">{{ $row->nama_nyewa }}</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item bg-primary text-white">Detail Alat </li>
                                    <li class="list-group-item">
                                        <div class="d-flex" style="justify-content: center">
                                            <img src="{{ asset("assets/img/" . $row->img) }}" style="width:250px;height:auto" class="img-thumbnail" alt="">
                                        </div>
                                    </li>
                                    <li class="list-group-item">Jenis : {{ $row->jenis }}</li>
                                    <li class="list-group-item">Satuan : {{ $row->satuan }}</li>
                                    <li class="list-group-item">Biaya : Rp. {{ number_format($row->biaya,0) }} Perbulan</li>
                                    <li class="list-group-item">Expired : {{ date("d, F Y",strtotime($row->expired)) }}</li>
                                    <li class="list-group-item">Unit : {{ $row->unit }} Unit</li>
                                    <li class="list-group-item">{{ $row->pesan }}</li>
                                    <li class="list-group-item">
                                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#detail{{ $row->id }}">Pesan</a>
                                            <div class="modal fade" id="detail{{ $row->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog  modal-lg" role="document">
                                                    <form method="POST" enctype="multipart/form-data" class="modal-content"
                                                        action="{{ url('pesan_sekarang') }}">
                                                        <input type="hidden" name="id" value="{{ $row->id }}">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalFullTitle">Isikan Form Dibawah Ini</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                           <div class="mb-1">
                                                            <label for="">Lama Nyewa</label>
                                                            <select name="lama_nyewa" id="" class="form-control" required>
                                                                <option value="">Pilih</option>
                                                                <option value="1 Bulan">1 Bulan</option>
                                                                <option value="3 Bulan">3 Bulan</option>
                                                                <option value="6 Bulan">6 Bulan</option>
                                                                <option value="1 Tahun">1 Tahun</option>
                                                                <option value="2 Tahun">2 Tahun</option>
                                                                <option value="3 Tahun">3 Tahun</option>
                                                                <option value="4 Tahun">4 Tahun</option>
                                                                <option value="5 Tahun">5 Tahun</option>
                                                            </select>
                                                           </div>
                                                           <br>
                                                           <div class="mb-1">
                                                            <label for="">Alamat</label>
                                                            <textarea name="alamat" id="" class="form-control" required cols="30" rows="5"></textarea>
                                                           </div>
                                                           <br>
                                                           <div class="mb-1">
                                                            <label for="">No Hp</label>
                                                            <input type="number" class="form-control" name="no_hp" required>
                                                           </div>
                                                           <br>
                                                           <div class="mb-1">
                                                            <label for="">Unit Yang Di Sewa</label>
                                                            <select name="unit_sewa" class="form-control " required  id="">
                                                                <option value="">Pilih</option>
                                                                <option value="1">1 Unit</option>
                                                                <option value="2">2 Unit</option>
                                                                <option value="3">3 Unit</option>
                                                                <option value="1">4 Unit</option>
                                                                <option value="5">5 Unit</option>
                                                                <option value="6">6 Unit</option>
                                                                <option value="7">7 Unit</option>
                                                                <option value="8">8 Unit</option>
                                                                <option value="9">9 Unit</option>
                                                                <option value="10">10 Unit</option>
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
                                                            <button type="submit" class="btn btn-primary">Pesan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
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
