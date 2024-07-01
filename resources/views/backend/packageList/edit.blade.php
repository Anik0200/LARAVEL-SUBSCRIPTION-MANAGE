@extends('layouts.backend')
@section('Title', 'edit-package-list')
@section('contetn_header', 'EDIT PACKAGE LIST')

@section('content')
    <div class="row" style="display: flex; justify-content: center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('packageList.update', $list->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>User Name</label>
                            <select name="user_id" class="form-control">
                                @forelse ($users as $user)
                                    <option @selected($list->user_id == $user->id) value="{{ $user->id }}">
                                        {{ $user->name }}
                                    </option>
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
                                @forelse ($packages as $package)
                                    <option @selected($list->package_id == $package->id) value="{{ $package->id }}">
                                        {{ $package->package_name }}
                                    </option>
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
                            <input onclick="$(this).attr('type', 'date')" type="text"
                                value="{{ date('m-d-Y', strtotime($list->start_date)) }}" name="start_date"
                                class="form-control editDateIn">

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
