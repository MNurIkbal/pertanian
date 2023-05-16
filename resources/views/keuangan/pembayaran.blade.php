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
            <div style="margin-left: 20px;">
                <h5>Nama Penyewa : {{ $main->name }}</h5>
                <h5>Nama Alat : {{ $first->nama_nyewa }}</h5>
                <h5>Biaya : Rp. {{ number_format($first->biaya,0) }}</h5>
            </div>
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
                @if ($hasil->status == "aktif")
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
                                <input type="text" class="form-control" required placeholder="Nominal" name="nominal" id="bayars">
                            </div>
                            <script type="text/javascript">
		
                                var rupiah = document.getElementById('bayars');
                                rupiah.addEventListener('keyup', function(e){
                                    // tambahkan 'Rp.' pada saat form di ketik
                                    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                                    rupiah.value = formatRupiah(this.value, 'Rp. ');
                                });
                         
                                /* Fungsi formatRupiah */
                                function formatRupiah(angka, prefix){
                                    var number_string = angka.replace(/[^,\d]/g, '').toString(),
                                    split   		= number_string.split(','),
                                    sisa     		= split[0].length % 3,
                                    rupiah     		= split[0].substr(0, sisa),
                                    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
                         
                                    // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                    if(ribuan){
                                        separator = sisa ? '.' : '';
                                        rupiah += separator + ribuan.join('.');
                                    }
                         
                                    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                                    return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
                                }
                            </script>
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
                @endif
                @if ($check && $hasil->status == "aktif")
                <a href="{{ url("selesai_bayar/$id/$user_id") }}" class="btn btn-success mb-4">Selesai</a>
                @endif
                <br>
                <div class="row">
                    @foreach ($result as $row)   
                    <div class="col-md-6 mt-4">
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
                                    <li class="list-group-item">Dibuat : {{ date("d, F Y",strtotime($row->created_at)) }}</li>
                                    
                                    <li class="list-group-item">Pesan : {{ $row->pesan }}</li>
                                    <li class="list-group-item">
                                        <a href="{{ asset("assets/img/" . $row->img) }}" download class="btn btn-success">Download</a>
                                        @if ($hasil->status == "aktif")
                                        <a href="#"  class="btn btn-primary"  data-bs-toggle="modal"
                                        data-bs-target="#edit{{ $row->id }}">Edit</a>
                                        <div class="modal fade" id="edit{{ $row->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog  modal-lg" role="document">
                                            <form method="POST" enctype="multipart/form-data" class="modal-content"
                                                action="{{ url('edit_bayar_sekarang') }}">
                                                <input type="hidden" name="id" value="{{ $id }}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalFullTitle">Edit Pembayaran</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                               <div class="modal-body">
                                                <div class="mb-1">
                                                    <label for="">Nominal</label>
                                                    <input type="text" value="{{ $row->nominal }}" class="form-control" required placeholder="Nominal" name="nominal" id="nominals">
                                                </div>
                                                <script type="text/javascript">
		
                                                    var rupiaht{{$row->id}} = document.getElementById('nominals');
                                                    rupiaht{{$row->id}}.addEventListener('keyup', function(e){
                                                        // tambahkan 'Rp.' pada saat form di ketik
                                                        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                                                        rupiaht{{$row->id}}.value = formatRupiah{{$row->id}}(this.value, 'Rp. ');
                                                    });
                                             
                                                    /* Fungsi formatRupiah */
                                                    function formatRupiah{{$row->id}}(angka, prefix){
                                                        var number_string = angka.replace(/[^,\d]/g, '').toString(),
                                                        split   		= number_string.split(','),
                                                        sisa     		= split[0].length % 3,
                                                        rupiaht{{$row->id}}     		= split[0].substr(0, sisa),
                                                        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
                                             
                                                        // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                                        if(ribuan){
                                                            separator = sisa ? '.' : '';
                                                            rupiaht{{$row->id}} += separator + ribuan.join('.');
                                                        }
                                             
                                                        rupiaht{{$row->id}} = split[1] != undefined ? rupiaht{{$row->id}} + ',' + split[1] : rupiaht{{$row->id}};
                                                        return prefix == undefined ? rupiaht{{$row->id}} : (rupiaht{{$row->id}} ? '' + rupiaht{{$row->id}} : '');
                                                    }
                                                </script>
                                                <br>  
                                                <div class="mb-1">
                                                    <label for="">Bukti Foto</label>
                                                    <input type="file" class="form-control"  placeholder="foto" name="foto">
                                                    <input type="hidden" name="foto_lama" value="{{ $row->img }}">
                                                </div>
                                                <br>  
                                                <div class="mb-1">
                                                    <label for="">Pesan</label>
                                                    <textarea name="pesan" id="pesan" class="form-control" required placeholder="Pesan" cols="30" rows="10">{{ $row->pesan }}</textarea>
                                                </div>
                                                <br>  
                                               </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                        <a href="{{ url('hapus_bayar/' . $row->id) }}"  class="btn btn-danger">Hapus</a>
                                        @endif
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
