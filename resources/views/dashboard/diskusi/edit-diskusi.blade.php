@extends('layouts.main2')

@section('title')
    Edit Diskusi
@endsection

@section('diskusi')
active
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="card-header mx-1">
                        <h5>Edit Diskusi</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('diskusi.update', ['id' => Crypt::encrypt($diskusi->id)]) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="judul">Judul</label>
                                <input type="text" id="judul" name="judul" class="form-control @error('judul') is-invalid
                            @enderror" placeholder="Judul anda" value="{{ old('judul', $diskusi->judul) }}" required>
                                @error('judul')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="content">Isi</label>
                                <textarea class="form-control @error('content') is-invalid
                            @enderror" id="content" name="content" rows="4" placeholder="Isi diskusi"
                                    required>{{ old('content', $diskusi->content) }}</textarea>
                                @error('content')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection