@extends('layouts.backend')
@section('Title', 'edit-package')
@section('contetn_header', 'EDIT PACKAGE')

@section('content')
    <div class="row" style="display: flex; justify-content: center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('package.update', $package->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="package_name" value="{{ $package->package_name }}"
                                class="form-control" placeholder="Name Here ..">
                            <div class="form-text text-white">Only Tweenty Characters Support.</div>

                            @error('package_name')
                                <p class="text-danger text-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Duration</label>
                            <input type="number" name="package_duartion" value="{{ $package->package_duartion }}"
                                class="form-control" placeholder="Duration Here ..">
                            <div class="form-text text-white">Only Number Support.</div>

                            @error('package_duartion')
                                <p class="text-danger text-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="package_price" value="{{ $package->package_price }}"
                                class="form-control" placeholder="Price Here ..">
                            <div class="form-text text-white">Only Number Support.</div>

                            @error('package_price')
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
