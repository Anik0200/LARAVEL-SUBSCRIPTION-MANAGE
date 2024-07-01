@extends('layouts.backend')
@section('Title', 'All-Users')
@section('contetn_header', 'ALL USERS')

@section('buttons')
    <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">+ Add New</a>
@endsection

@section('content')
    <div class="row  d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Facebook</th>
                                <th>Package</th>
                                <th>Start Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->email }}</td>

                                    <td>
                                        <a class="badge badge-info" href="{{ $user->facebook }}">
                                            Account
                                        </a>
                                    </td>

                                    <td>{{ $user->package->package_name }}</td>

                                    <td>{{ $user->start_date }}</td>

                                    <td>
                                        <a class="{{ $user->status == 1 ? 'badge badge-info' : 'badge badge-dark' }}">
                                            {{ $user->status == 1 ? 'Active' : 'Deactive' }}
                                        </a>
                                    </td>
                                    <td class="d-flex">

                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary ml-2">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        @if ($user->status == 1)
                                            <a href="{{ route('user.deActive', $user->id) }}"
                                                class="btn btn-sm btn-warning ml-2">
                                                <i class="fa fa-arrow-down"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('user.active', $user->id) }}"
                                                class="btn btn-sm btn-success ml-2">
                                                <i class="fa fa-arrow-up"></i>
                                            </a>
                                        @endif

                                        <form method="POST" action="{{ route('user.delete', $user->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <a class="btn btn-sm btn-danger userDlt ml-2">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script>
        $(document).on('click', '.userDlt', function(e) {
            e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('.userDlt').parent('form:first').submit();
                }
            });
        });
    </script>

    @include('inc.tostr')
@endsection
