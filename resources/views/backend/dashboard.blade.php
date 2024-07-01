@extends('layouts.backend')
@section('Title', 'DashBoard')

@section('content')
    <div class="row" style="display: flex; justify-content: center">
        <div class="col-md-4">
            <div class="card mt-5">
                <div class="card-body text-center">
                    WellCome {{ Auth::user()->name }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('inc.tostr')
@endsection
