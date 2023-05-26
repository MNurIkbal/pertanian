@extends('layouts.main2')

@section('title')
Manajemen User
@endsection

@section('manajemen-user')
active
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="card-body">
                    <h4>Tambah Akun Petani</h4>
                    <form action="{{ route('manajemen-user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Nama</label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid
                        @enderror" placeholder="Nama anda" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" class="form-control @error('email') is-invalid
                        @enderror" placeholder="contoh@mail.com" value="{{ old('email') }}" required>
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="photo_profile">Foto Profile</label>
                            <input type="file" id="photo_profile" name="photo_profile" class="form-control @error('photo_profile') is-invalid
                        @enderror" placeholder="contoh@mail.com" value="{{ old('photo_profile') }}">
                            @error('photo_profile')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid
                        @enderror" value="{{ old('password') }}" required>
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid
                        @enderror" value="{{ old('password_confirmation') }}" required>
                            @error('password_confirmation')
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
@endsection
