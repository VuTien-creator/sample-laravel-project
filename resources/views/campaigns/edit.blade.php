@extends('layouts.main')
@section('main')

            <form class="needs-validation" novalidate action="{{ route('campaign.update',$campaign) }}" method="POST">
                @method("PUT")
                @csrf

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputName">Name</label>
                        <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                        <input type="text" class="form-control {{ $errors->first('name')?'is-invalid':'' }}" id="inputName" name="name" placeholder="" value="{{ old('name')??$campaign->name }}">
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputSlug">Slug</label>
                        <input type="text" class="form-control {{ $errors->first('slug')?'is-invalid':'' }}" id="inputSlug" name="slug" placeholder="" value="{{ old('slug')??$campaign->slug }}">
                        <div class="invalid-feedback">
                            {{ $errors->first('slug') }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputDate">Date</label>
                        <input type="text"
                               class="form-control {{ $errors->first('date')?'is-invalid':'' }}"
                               id="inputDate"
                               name="date"
                               placeholder="yyyy-mm-dd"
                               value="{{ old('date')??$campaign->date }}">
                               <div class="invalid-feedback">
                                {{ $errors->first('date') }}
                            </div>
                    </div>
                </div>

                <hr class="mb-4">
                <button class="btn btn-primary" type="submit">Save</button>
                <a href="{{ route('campaign.show',$campaign) }}" class="btn btn-link">Cancel</a>
            </form>

@endsection
