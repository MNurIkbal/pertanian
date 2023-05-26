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
                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $informasi->judul }}</h5>
                    <div class="my-1">
                        @if ($informasi->created_at == $informasi->updated_at)
                        <small>Oleh: {{ $informasi->user->name }}, dibuat pada: {{ $informasi->updated_at }}</small>
                        @else
                        <small>Oleh: {{ $informasi->user->name }}, diupdate pada: {{ $informasi->updated_at }}</small>
                        @endif
                    </div>
                    <p class="mb-4">
                        {!! $informasi->body !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="text-primary">Tambahkan Komentar</h5>
                <form action="{{ route('komentar-informasi.store', ['id' => $informasi->id]) }}" method="POST">
                    @csrf
                    <textarea class="form-control @error('content') is-invalid
                        @enderror" name="content" id="" cols="30" rows="4">{{ old('content') }}</textarea>
                    @error('content')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 mt-2">
        <div class="card">
            <div class="card-body p-4">
                <h4 class="text-center mb-4 pb-2 text-primary">Komentar</h4>

                <div class="row">
                    <div class="col">
                        @for ($i = 0; $i < count($komentars); $i++) 
                            <div class="d-flex flex-start mt-4">
                                <a class="me-3" href="#">
                                    @if ($komentars[$i]->user->photo_profile == null)
                                        <img class="rounded-circle shadow-1-strong me-3"
                                            src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(12).webp" alt="avatar"
                                            width="65" height="65" />
                                    @else
                                        <img class="rounded-circle shadow-1-strong me-3"
                                            src="{{ asset($komentars[$i]->user->photo_profile) }}" alt="avatar"
                                            width="65" height="65" />
                                    @endif
                                </a>
                                <div class="flex-grow-1 flex-shrink-1">
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="mb-1">
                                                {{ $komentars[$i]->user->name }} <span class="small">- @if ($komentars[$i]->created_at == $komentars[$i]->updated_at)
                                                    Dibuat pada: {{ $komentars[$i]->updated_at }}
                                                    @else
                                                    Diupdate pada: {{ $komentars[$i]->updated_at }}
                                                    @endif</span>
                                            </p>
                                            <div class="button">
                                                @if (Auth::user()->id == $komentars[$i]->user_id)
                                                <a data-bs-toggle="collapse" href="#collapseEdit{{ $komentars[$i]->id }}" role="button" aria-expanded="false"
                                                    aria-controls="collapseExample" class=""><i class="fas fa-reply fa-xs"></i><span class="small">
                                                        edit</span></a>
                                                @endif
                                                <a data-bs-toggle="collapse" href="#collapseExample{{ $komentars[$i]->id }}" role="button" aria-expanded="false"
                                                    aria-controls="collapseExample" class=""><i class="fas fa-reply fa-xs"></i><span class="small">
                                                        reply</span></a>
                                            </div>
                                        </div>
                                        <p class="small mb-0">
                                            {{ $komentars[$i]->content }}
                                        </p>
                                        <div class="collapse" id="collapseExample{{ $komentars[$i]->id }}">
                                            <div class="card card-body">
                                                <form
                                                    action="{{ route('komentar-informasi.store-komentar', ['informasi_id' => $komentars[$i]->informasi_id, 'komentar_id' => $komentars[$i]->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <textarea class="form-control @error('content2') is-invalid @enderror" name="content2" id="" cols="30"
                                                        rows="2">{{ old('content2') }}</textarea>
                                                    @error('content2')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <div class="d-flex justify-content-end mt-3">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="collapse" id="collapseEdit{{ $komentars[$i]->id }}">
                                            <div class="card card-body">
                                                <form action="{{ route('komentar-informasi.update', ['id' => $komentars[$i]->id]) }}" method="POST">
                                                    @csrf
                                                    <textarea class="form-control @error('content_update') is-invalid @enderror" name="content_update" id=""
                                                        cols="30" rows="2">{{ old('content_update', $komentars[$i]->content) }}</textarea>
                                                    @error('content_update')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <div class="d-flex justify-content-end mt-3">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    @for ($j = 0; $j < count($nastedKomentar); $j++)
                                    @if ($nastedKomentar[$j]->komentar_informasi_id == $komentars[$i]->id)
                                    <div class="d-flex flex-start mt-4">
                                        <a class="me-3" href="#">
                                            @if ($nastedKomentar[$j]->user->photo_profile == null)
                                                <img class="rounded-circle shadow-1-strong me-3"
                                                    src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(12).webp" alt="avatar"
                                                    width="65" height="65" />
                                            @else
                                                <img class="rounded-circle shadow-1-strong me-3"
                                                    src="{{ asset($nastedKomentar[$j]->user->photo_profile) }}" alt="avatar"
                                                    width="65" height="65" />
                                            @endif
                                        </a>
                                        <div class="flex-grow-1 flex-shrink-1">
                                            <div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="mb-1">
                                                        {{ $nastedKomentar[$j]->user->name }} <span class="small">- @if ($nastedKomentar[$j]->created_at == $nastedKomentar[$j]->updated_at)
                                                            Dibuat pada: {{ $nastedKomentar[$j]->updated_at }}
                                                            @else
                                                            Diupdate pada: {{ $nastedKomentar[$j]->updated_at }}
                                                            @endif 
                                                        </span>
                                                    </p>
                                                </div>
                                                <p class="small mb-0">
                                                    {{ $nastedKomentar[$j]->content }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @endfor
                                </div>
                            </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
