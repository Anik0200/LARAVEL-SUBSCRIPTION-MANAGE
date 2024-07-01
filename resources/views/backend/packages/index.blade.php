@extends('layouts.backend')
@section('Title', 'all-package')
@section('contetn_header', 'ALL PACKAGE')

@section('buttons')
    <a href="{{ route('package.create') }}" class="btn btn-sm btn-primary">+ Add New</a>
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
                                <th>Duration</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($packages as $package)
                                <tr>
                                    <td>{{ $package->id }}</td>
                                    <td>{{ $package->package_name }}</td>
                                    <td>{{ $package->package_duartion }} Days</td>
                                    <td>{{ $package->package_price }} BDT</td>

                                    <td>
                                        <a
                                            class="{{ $package->package_status == 1 ? 'badge badge-info' : 'badge badge-dark' }}">
                                            {{ $package->package_status == 1 ? 'Active' : 'Deactive' }}
                                        </a>
                                    </td>

                                    <td class="d-flex">
                                        <a href="{{ route('package.edit', $package->id) }}"
                                            class="btn btn-sm btn-primary ml-2">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        @if ($package->package_status == 1)
                                            <a href="{{ route('package.deActive', $package->id) }}"
                                                class="btn btn-sm btn-warning ml-2">
                                                <i class="fa fa-arrow-down"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('package.active', $package->id) }}"
                                                class="btn btn-sm btn-success ml-2">
                                                <i class="fa fa-arrow-up"></i>
                                            </a>
                                        @endif

                                        <form method="POST" action="{{ route('package.delete', $package->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <a class="btn btn-sm btn-danger pckgDlt ml-2">
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
        $(document).on('click', '.pckgDlt', function(e) {
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
                    $('.pckgDlt').parent('form:first').submit();
                }
            });
        });
    </script>

    @include('inc.tostr')
@endsection
