@extends('layouts.main2')

@section('title')
Informasi
@endsection

@section('informasi')
active
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Informasi</h5>

                            <p class="mb-4">
                                Dalam menu ini anda dapat melihat informasi menarik terkait pertanian yang sudah dibuat oleh admin.
                            </p>
                            @if (Auth::user()->role_id == 1)
                            <a href="{{ route('informasi.create') }}" class="btn btn-sm btn-outline-primary">Buat Informasi</a>
                            @endif
                            <div class="mt-2">
                                @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                                @endif
                                @if (session()->has('error'))
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('./asset-dashboard/img/illustrations/news.png') }}"
                                height="140" alt="View Badge User"
                                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-2">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('diskusi.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}">
                            <button class="btn btn-danger" type="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @foreach ($informasi as $item)
        <div class="col-lg-3 col-md-4 col-sm-6 order-0">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->judul }}</h5>

                    <p class="card-text">
                        @if ($item->created_at == $item->updated_at)
                            <small>Oleh: {{ $item->user->name }}, dibuat pada: {{ $item->updated_at }}</small>
                        @else
                            <small>Oleh: {{ $item->user->name }}, diupdate pada: {{ $item->updated_at }}</small>
                        @endif
                    </p>
                    <div class="d-flex justify-content-end">
                        <div class="mx-1">
                            <a href="{{ route('informasi.show', ['id' => Crypt::encrypt($item->id)]) }}" class="btn btn-primary">Lihat</a>
                        </div>
                        @if (Auth::user()->id == $item->user->id)
                        <div class="mx-1">
                            <a href="{{ route('informasi.edit', ['id' => Crypt::encrypt($item->id)]) }}"
                                class="btn btn-warning">Edit</a>
                        </div>
                        <div class="mx-1">
                            <form action="{{ route('informasi.delete', ['id' => Crypt::encrypt($item->id)]) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-danger" type="submit">
                                    Hapus
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        @endforeach
        <div class="d-flex justify-content-center">
            {{ $informasi->onEachSide(5)->links() }}
        </div>
    </div>
</div>
@endsection


