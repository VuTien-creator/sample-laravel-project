@extends('layouts.main')
@section('main')
            <div class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Create new Place</h2>
                </div>
            </div>

            <form class="needs-validation" novalidate action="{{ route('place.store',$campaign) }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputName">Name</label>
                        <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                        <input type="text" class="form-control {{ $errors->first('name')?'is-invalid':'' }}" id="inputName" name="name" placeholder="" value="{{ old('name') }}">
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="selectChannel">Area</label>
                        <select class="form-control {{ $errors->first('area_id')?'is-invalid':'' }}" id="selectChannel" name="area_id">
                            @foreach ($campaign->area as $area)
                            <option value="{{ $area->id }}" {{ old('area_id')==$area->id?'selected':'' }}>{{ $area->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('area_id') }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputCapacity">Capacity</label>
                        <input type="number" class="form-control {{ $errors->first('capacity')?'is-invalid':'' }}" id="inputCapacity" name="capacity" placeholder="" value="{{ old('capacity') }}">
                        <div class="invalid-feedback">
                            {{ $errors->first('capacity') }}
                        </div>
                    </div>
                </div>

                <hr class="mb-4">
                <button class="btn btn-primary" type="submit">Save place</button>
                <a href="{{ route('campaign.show',$campaign) }}" class="btn btn-link">Cancel</a>
            </form>
@endsection
