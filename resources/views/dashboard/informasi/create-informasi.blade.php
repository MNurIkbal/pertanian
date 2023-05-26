@extends('layouts.main2')

@section('title')
    Informasi
@endsection

@section('informasi')
active
@endsection

@section('css')

<script src="https://code.jquery.com/jquery-3.7.0.slim.js" integrity="sha256-7GO+jepT9gJe9LB4XFf8snVOjX3iYNb0FHYr5LI1N5c=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="card-header mx-1">
                        <h5>Tambahkan Informasi</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('informasi.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="judul">Judul</label>
                                <input type="text" id="judul" name="judul" class="form-control @error('judul') is-invalid
                            @enderror" placeholder="Judul anda" value="{{ old('judul') }}" required>
                                @error('judul')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="isi-body">Isi</label>
                                <textarea class="form-control @error('body') is-invalid
                            @enderror" id="isi-body" name="body" rows="4"
                                    required>{{ old('body') }}</textarea>
                                @error('body')
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
@section('script')
<script>
    $(document).ready(function () {
        $('#isi-body').summernote();
    });

</script>

@endsection