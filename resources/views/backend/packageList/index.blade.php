@extends('layouts.backend')
@section('Title', 'all-package-list')
@section('contetn_header', 'RUNNING PACKAGE LIST')

@section('content')
    <div class="row  d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>Package Name</th>
                                <th>Duration</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lists as $list)
                                @php
                                    $notified_date = $list->start_date?->addDay($list->package->package_duartion - 2);
                                @endphp

                                @if ($notified_date > now())
                                    <tr>
                                        <td>{{ $list->id }}</td>
                                        <td>{{ $list->name }}</td>
                                        <td>{{ $list->email }}</td>
                                        <td>{{ $list->package->package_name }}</td>
                                        <td>{{ $list->package->package_duartion . ' ' . 'Days' }}</td>


                                        <td>
                                            <a class="{{ $notified_date > now() ? 'badge badge-info' : '' }}">
                                                {{ $notified_date > now() ? 'Running' : '' }}
                                            </a>
                                        </td>
                                    </tr>
                                @endif
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
        $(document).on('click', '.pckgListDlt', function(e) {
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
                    $('.pckgListDlt').parent('form:first').submit();
                }
            });
        });
    </script>

    @include('inc.tostr')
@endsection
