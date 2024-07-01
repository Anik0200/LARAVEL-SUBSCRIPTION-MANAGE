@extends('layouts.backend')
@section('Title', 'Profile')
@section('contetn_header', 'Profile')

@section('content')
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline pt-5 pb-3">
                <div class="card-body box-profile">
                    <div class="text-center">

                        @if (file_exists('storage/images/' . Auth::user()->image) && Auth::user()->image != null)
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('storage/images/' . Auth::user()->image) }}" alt="User profile picture">
                        @else
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('storage/images/user-3296.png') }}" alt="User profile picture">
                        @endif

                    </div>

                    <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                    <p class="text-muted text-center">YOU ARE {{ Auth::user()->role == 1 ? 'ADMIN' : 'HACKER' }}</p>

                    <a href="{{ route('password.request') }}" class="btn btn-primary btn-block mt-2"><b>Reset
                            Password</b></a>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->

        <div class="col-md-9">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('profile.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>

                            <div class="col-sm-10">
                                <input value="{{ Auth::user()->name }}" name="name" type="text" class="form-control"
                                    id="inputName" placeholder="Name">

                                @error('name')
                                    <p class="text-danger text-bold mb-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>

                            <div class="col-sm-10">
                                <input value="{{ Auth::user()->email }}" name="email" type="email" class="form-control"
                                    id="inputEmail" placeholder="Email">

                                @error('email')
                                    <p class="text-danger text-bold mb-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Phone</label>

                            <div class="col-sm-10">
                                <input value="{{ Auth::user()->phone }}" name="phone" type="text" class="form-control"
                                    id="inputName2" placeholder="Name">

                                @error('phone')
                                    <p class="text-danger text-bold mb-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Iamge</label>

                            <div class="col-sm-10">
                                <input name="image" type="file" accept="image/*" onchange="readURL(this);"
                                    class="upload form-control">

                                <img class="mt-2 rounded" id="image" src="" alt="" width="60">

                                @error('image')
                                    <p class="text-danger text-bold mb-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-danger">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection

@section('js')
    @include('inc.tostr')

    <script>
        //Showing Input Iamage With js
        function readURL(input) {
            if (input.files && input.files[0]) {

                var reader = new FileReader();

                reader.onload = function(e) {
                    console.log(e.target.result);
                    $('#image')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
