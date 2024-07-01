@extends('layouts.backend')
@section('Title', 'report-list')
@section('contetn_header', 'REPORT LSIT')

@section('buttons')
    <form class="s_form d-flex align-items-center">
        @csrf

        <select name="days" class="form-control mr-2 days">
            <option value="7">7 days</option>
            <option value="15">15 days</option>
            <option value="30">30 days</option>
        </select>

        <input type="date" name="start_date" class="form-control mr-2">

        {{-- <input type="date" name="custom" class="form-control mr-2"> --}}

        <a class="btn btn-sm btn-danger sBtn">
            Filter
        </a>
    </form>
@endsection

@section('content')
    <div class="row  d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-dark table-striped report">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>User Name</th>
                                <th>Package Name</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($reports as $report)
                                @php
                                    $total += $report->package->package_price;
                                @endphp
                                <tr>
                                    <td>{{ $report->id }}</td>
                                    <td>{{ $report->name ?? '' }}</td>
                                    <td>{{ $report->package->package_name ?? '' }}</td>
                                    <td>{{ $report->package->package_price ?? '' }} BDT</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <p class="badge badge-lg badge-info text-5">Total Amount {{ $total }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).on('click', '.sBtn', function(e) {
            e.preventDefault();

            var sForm = $('.s_form')[0];
            var sData = new FormData(sForm);

            $.ajax({
                type: "POST",
                url: "{{ route('report.sorting') }}",
                data: sData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status == 200) {
                        var res = '';
                        $.each(response.data, function(index, value) {
                            res +=
                                '<tr>' +
                                '<td>' + value.id + '</td>' +
                                '<td>' + value.name + '</td>' +
                                '<td>' + value.package.package_name + '</td>' +
                                '<td>' + value.package.package_price + '</td>' +
                                '</tr>';
                        });
                        $('tbody').html(res);
                    }
                }
            });
        });

        $(document).on('change', '.days', function(e) {
            e.preventDefault();
            var days = $(this).val();

            $.ajax({
                type: "POST",
                url: "{{ route('report.sorting') }}",
                data: {
                    days: days
                },
                success: function(response) {
                    if (response.status == 200) {
                        var res = '';
                        $.each(response.data, function(index, value) {
                            res +=
                                '<tr>' +
                                '<td>' + value.id + '</td>' +
                                '<td>' + value.name + '</td>' +
                                '<td>' + value.package.package_name + '</td>' +
                                '<td>' + value.package.package_price + '</td>' +
                                '</tr>';
                        });
                        $('tbody').html(res);
                    }
                }
            });

        });
    </script>
@endsection
