@extends('layouts.backend')
@section('Title', 'create-package-list')
@section('contetn_header', 'CREATE PACKAGE LIST')

@section('content')
    <div class="row" style="display: flex; justify-content: center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('packageList.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>User Name</label>
                            <select name="user_id" class="form-control">
                                <option selected disabled>Select Here..</option>
                                @forelse ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @empty
                                    <option selected disabled>No Data Here</option>
                                @endforelse
                            </select>

                            @error('user_id')
                                <p class="text-danger text-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Packge Name</label>
                            <select name="package_id" class="form-control">
                                <option selected disabled>Select Here..</option>
                                @forelse ($packages as $package)
                                    <option value="{{ $package->id }}">{{ $package->package_name }}</option>
                                @empty
                                    <option selected disabled>No Data Here</option>
                                @endforelse
                            </select>

                            @error('package_id')
                                <p class="text-danger text-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" name="start_date" class="form-control">

                            @error('start_date')
                                <p class="text-danger text-bold">{{ $message }}</p>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('inc.tostr')
@endsection
