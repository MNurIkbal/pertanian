@extends('layouts.main2')

@section('title')
Profile
@endsection

@section('profile')
active
@endsection

@section('css')

<script src="https://code.jquery.com/jquery-3.7.0.slim.js" integrity="sha256-7GO+jepT9gJe9LB4XFf8snVOjX3iYNb0FHYr5LI1N5c=" crossorigin="anonymous"></script>

@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h5 class="card-title text-primary">Profile</h5>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Profile Details</h5>
                <!-- Account -->
                <form method="POST" action="{{ route('profile.update') }}" class="mb-2" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            @if ($user->photo_profile != null)
                                <img src="{{ asset($user->photo_profile) }}" alt="user-avatar"
                                class="d-block rounded" height="100" width="100" id="uploadedAvatar1" />
                            @else

                            <img src="{{ asset('../asset-dashboard/img/avatars/1.png') }}" alt="user-avatar"
                                class="d-block rounded" height="100" width="100" id="uploadedAvatar2" />
                            @endif
                                <img  class="img-preview d-block rounded" height="100" width="100"
                                    id="uploadedAvatar3" hidden/>

                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" name="photo_profile" class="account-file-input"
                                        hidden />
                                    @error('photo_profile')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </label>
                                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">

                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="name">Nama</label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid
                        @enderror" placeholder="Nama anda" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" class="form-control @error('email') is-invalid
                        @enderror" placeholder="contoh@mail.com" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                        </div>

                    </div>
                    <!-- /Account -->
                </form>
            </div>

            <div class="card">
                <h5 class="card-header">Ganti Password</h5>
                <div class="card-body">
                    <form action="{{ route('profile.password') }}" method="POST">
                        @csrf
                        <div class="mb-3 col-md-12">
                            <label for="current_password">Password sekarang</label>
                            <input type="password" id="current_password" name="current_password" class="form-control @error('current_password') is-invalid
                        @enderror" value="{{ old('current_password') }}">
                            @error('current_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="password">Password Baru</label>
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid
                        @enderror" value="{{ old('password') }}">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="password_confirmation">Konfirmasi Password Baru</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid
                        @enderror" value="{{ old('password_confirmation') }}">
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {


        $(document).on('change', '#upload', function () {
            var allGood = true;

            const image = document.querySelector('#upload');
            const imgPreview = document.querySelector('#uploadedAvatar3');
            // var lastInputField = ;

            if ($(this).val() == "") {
                console.log('false');
                return allGood = false;
            }
            if (allGood) {
                imgPreview.style.display = 'block';
                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);

                oFReader.onload = function (oFREvent) {
                    imgPreview.src = oFREvent.target.result;
                }
            }
        });

    });


    function previewImage() {
        const image = document.querySelector('#upload');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }

</script>
@endsection
