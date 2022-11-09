@extends('layouts.app')

@section('content')
    <div class="container">
        @can('create-vehicles')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title m-b-0">@lang('vehicle.createVeh')</h3>

                        <form action="{{ route('admin.vehicles.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="vehicle_image">@lang('global.image'):</label>
                                        <input type="file" class="form-control-file" id="vehicle_image" name="vehicle_image">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">@lang('global.name')*</label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Vehicle Full name..." required>
                                    </div>

                                    <div class="form-group">
                                        <label for="brand">@lang('vehicle.brand')*</label>
                                        <input type="text" name="brand" class="form-control" id="brand" placeholder="Vehicle Brand..." required>
                                    </div>

                                    <div class="form-group">
                                        <label for="model">@lang('vehicle.model')*</label>
                                        <input type="text" name="model" class="form-control" id="model" placeholder="Vehicle Model..." required>
                                    </div>

                                    <div class="form-group">
                                        <label for="year_model">@lang('vehicle.yearModel')*</label>
                                        <input type="number" name="year_model" class="form-control" id="year_model" placeholder="Vehicle Year Model..." required>
                                    </div>

                                    <div class="form-group">
                                        <label for="mileage_km">@lang('vehicle.mileage') (km)*</label>
                                        <input type="number" name="mileage_km" class="form-control" id="mileage_km" placeholder="Vehicle Mileage In Km..." required>
                                    </div>

                                    <div class="form-group">
                                        <label for="registration_number">@lang('vehicle.regNumber')*</label>
                                        <input type="text" name="registration_number" class="form-control" id="registration_number" placeholder="Registration Number..." required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vehicle_type">@lang('vehicle.vehicleType')*</label>
                                        <input type="text" name="vehicle_type" class="form-control" id="vehicle_type" placeholder="Vehicle Type..." required>
                                    </div>

                                    <div class="form-group">
                                        <label for="vehicle_category">@lang('vehicle.category') (AM, A, B...)*</label>
                                        <input type="text" name="vehicle_category" class="form-control" id="vehicle_category" placeholder="Vehicle Category..." required>
                                    </div>

                                    <div class="form-group">
                                        <label for="body_mass">@lang('vehicle.bodyMass') (kg)</label>
                                        <input type="number" name="body_mass" class="form-control" id="body_mass" placeholder="Body Mass In Kg...">
                                    </div>

                                    <div class="form-group">
                                        <label for="engine_capacity">@lang('vehicle.engineCap') (2.0, 3.0, 1.6...)*</label>
                                        <input type="text" name="engine_capacity" class="form-control" id="engine_capacity" placeholder="Engine Capacity..." required>
                                    </div>

                                    <div class="form-group">
                                        <label for="power_kw">@lang('vehicle.powerKw')*</label>
                                        <input type="number" name="power_kw" class="form-control" id="power_kw" placeholder="Power in Kw..." required>
                                    </div>

                                    <div class="form-group">
                                        <label for="average_consumption">@lang('vehicle.averageConsumption') (L/100km)</label>
                                        <input type="number" name="average_consumption" class="form-control" id="average_consumption" placeholder="Average Consumption In Litres...">
                                    </div>
                                </div>
                            </div>


                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">@lang('vehicle.desc')</label>
                                        <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_available" id="is_available" value="1" required>
                                            <label class="form-check-label" for="is_available">
                                                @lang('global.available')
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_available" id="is_available" value="0" required>
                                            <label class="form-check-label" for="not_available">
                                                @lang('global.unavailable')
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group d-flex justify-content-between">
                                        <button type="submit" class="btn btn-success">@lang('global.create')</button>
                                        <button type="reset" class="btn btn-danger">@lang('global.reset')</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endcan
    </div>
@endsection
