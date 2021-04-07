@extends('layouts.app', ['pageTitle' => 'Edit Office'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <form action="{{ route('web.admin.offices.update', $office->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card shadow p-4">
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-group row mb-3">
                                        <label class="col-md-3 col-form-label" for="provinces">Select Province</label>
                                        <div class="col-md-9">
                                            <select name="provinces" id="provinces" class="form-control"
                                                    aria-label="province">
                                                <option value="{{ $office->village->district->city->province->id }}">{{ $office->village->district->city->province->name }}</option>
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
                                                <option value="{{ $office->village->district->city->id }}">{{ $office->village->district->city->name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-md-3 col-form-label" for="districts">Select District</label>
                                        <div class="col-md-9">
                                            <select name="districts" id="districts" class="form-control"
                                                    aria-label="districts">
                                                <option value="{{ $office->village->district->id }}">{{ $office->village->district->name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-md-3 col-form-label" for="villages">Select Village</label>
                                        <div class="col-md-9">
                                            <select name="villages" id="villages" class="form-control"
                                                    aria-label="villages">
                                                <option value="{{ $office->village->id }}">{{ $office->village->name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow p-4">
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Office Name</label>
                                        <input type="text" name="name" class="form-control" id="name" value="{{ $office->name }}">
                                    </div>

                                    <label for="divisions">Office Divisions</label>
                                    <div class="form-group mb-3">
                                        <select name="divisions[]" id="divisions"
                                                class="form-control select2-dropdown-multiple" multiple>
                                            @foreach($divisions as $division)
                                                <option value="{{ $division->id }}" {{ $office->division->contains($division) ? 'selected' : '' }}>{{ $division->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="address">Office Address</label>
                                        <textarea class="form-control" id="address" name="address"
                                                  style="resize: none">{{ $office->address }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Save" class="btn btn-primary">
                                        <a href="{{ route('web.admin.offices.show', $office->id) }}" class="btn btn-dark">
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
