@extends('layouts.backend')
@section('Title', 'renew')
@section('contetn_header', 'RENEW')

@section('content')
    <div class="row" style="display: flex; justify-content: center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('notification.update', $list->id) }}" method="POST">
                        @csrf

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
