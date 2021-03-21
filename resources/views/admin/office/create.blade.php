@extends('layouts.app', ['pageTitle' => 'Add New Office'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <form action="{{ route('web.admin.offices.store') }}" method="POST">
                        @csrf
                        <div class="card shadow p-4" style="border-radius: 20px">
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-group row mb-3">
                                        <label class="col-md-3 col-form-label" for="provinces">Select Province</label>
                                        <div class="col-md-9">
                                            <select name="provinces" id="provinces" class="form-control"
                                                    aria-label="province">
                                                <option value="">Province</option>
                                                @foreach($provinces as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-md-3 col-form-label" for="cities">Select City</label>
                                        <div class="col-md-9">
                                            <select name="cities" id="cities" class="form-control" aria-label="cities">
                                                <option value="">City</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-md-3 col-form-label" for="districts">Select District</label>
                                        <div class="col-md-9">
                                            <select name="districts" id="districts" class="form-control"
                                                    aria-label="districts">
                                                <option value="">District</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-md-3 col-form-label" for="villages">Select Village</label>
                                        <div class="col-md-9">
                                            <select name="villages" id="villages" class="form-control"
                                                    aria-label="villages">
                                                <option value="">Village</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow p-4" style="border-radius: 20px">
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Office Name</label>
                                        <input type="text" name="name" class="form-control" id="name">
                                    </div>

                                    <label for="divisions">Office Divisions</label>
                                    <div class="form-group mb-3">
                                        <select name="divisions[]" id="divisions"
                                                class="form-control select2-dropdown-multiple" multiple>
                                            @foreach($divisions as $division)
                                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="address">Office Address</label>
                                        <textarea class="form-control" id="address" name="address"
                                                  style="resize: none"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Save" class="btn btn-primary">
                                        <a href="{{ route('web.admin.offices.index') }}" class="btn btn-dark">
                                            Cancel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        //select2 multiple dropdown
        $('.select2-dropdown-multiple').select2();
    </script>
    @include('layouts.partials.location-script')
@endsection
