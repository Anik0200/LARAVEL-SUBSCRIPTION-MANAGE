@extends('layouts.backend')
@section('Title', 'create-user')
@section('contetn_header', 'CREATE USERS')

@section('content')
    <div class="row" style="display: flex; justify-content: center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name Here ..">
                                    <div class="form-text text-white">Only Tweenty Characters Support.</div>

                                    @error('name')
                                        <p class="text-danger text-bold">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email Here ..">
                                    <div class="form-text text-white">Only Fifty Characters Support.</div>

                                    @error('email')
                                        <p class="text-danger text-bold">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Phone Here ..">
                                    <div class="form-text text-white">Only Fourteen Characters Support.</div>

                                    @error('phone')
                                        <p class="text-danger text-bold">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="text" name="facebook" class="form-control"
                                        placeholder="Facebook Here ..">
                                    <div class="form-text text-white">Use Only Facebook Id Number</div>

                                    @error('facebook')
                                        <p class="text-danger text-bold">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Package</label>

                                    <select name="package_id" class="form-select pkg" id="">
                                        <option selected disabled>Select Here..</option>
                                        @foreach ($packages as $package)
                                            <option value="{{ $package->id }}">{{ $package->package_name }}</option>
                                        @endforeach
                                    </select>

                                    <div class="form-text text-white">Select One Package</div>
                                </div>
                            </div>

                            <div class="col-md-6 duartion_none d-none">
                                <div class="form-group">
                                    <label>Duaration</label>
                                    <input disabled type="text" value="" class="form-control" id="duartion">
                                </div>
                            </div>

                            <div class="col-md-6 price_none d-none">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input disabled type="text" value="" class="form-control" id="price">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="date" name="start_date" class="form-control">

                                    @error('start_date')
                                        <p class="text-danger text-bold">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script>
        $(document).on('change', '.pkg', function(e) {
            e.preventDefault();
            var package_id = $(this).val();

            $('.duartion_none').removeClass('d-none');
            $('.price_none').removeClass('d-none');

            $.ajax({
                type: "POST",
                url: "{{ route('user.fetch') }}",
                data: {
                    package_id: package_id
                },
                success: function(response) {
                    $('#duartion').val(response.data.package_duartion + ' ' + "Days");
                    $('#price').val(response.data.package_price + ' ' + "BDT");
                }
            });

        });
    </script>

    @include('inc.tostr')
@endsection
