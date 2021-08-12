@extends('layouts.main')
@section('main')
            <div class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Edit session</h2>
                </div>
            </div>

            <form class="needs-validation" novalidate action="{{ route('session.update',[$campaign,$session]) }}" method="POST">
                @method("PUT")
                @csrf

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="selectType">Type</label>
                        <select class="form-control" id="selectType" name="type">
                            <option value="normal" {{ old('type')=='normal'?'selected':$session->type == 'normal'?'selected':'' }}>Normal</option>
                            <option value="service" {{ old('type')=='service'?'selected':$session->type == 'service'?'selected':'' }}>Service</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputTitle">Title</label>
                        <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                        <input type="text" class="form-control {{ $errors->first('title')?'is-invalid':'' }}" id="inputTitle" name="title" placeholder="" value="{{ old('title')??$session->title }}">
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputParticipant">Participant</label>
                        <input type="text" class="form-control {{ $errors->first('vaccinator')?'is-invalid':'' }}" id="inputParticipant" name="vaccinator" placeholder="" value="{{ old('vaccinator')??$session->vaccinator }}">
                        <div class="invalid-feedback">
                            {{ $errors->first('vaccinator') }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="selectPlace">Place</label>
                        <select class="form-control {{ $errors->first('place_id')?'is-invalid':'' }}" id="selectPlace" name="place_id">
                            @foreach ($campaign->place as $place)

                            <option value="{{ $place->id }}" {{ old('place_id')==$place->id?'selected':$session->place->id==$place->id?'selected':'' }}>{{ $place->name }} / {{ $place->area->name }}</option>
                            @endforeach

                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('place_id') }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputCost">Cost</label>
                        <input type="number" class="form-control {{ $errors->first('cost')?'is-invalid':'' }}" id="inputCost" name="cost" placeholder="" value="{{ old('cost')??$session->cost }}">
                        <div class="invalid-feedback">
                            {{ $errors->first('cost') }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-6 mb-3">
                        <label for="inputStart">Start</label>
                        <input type="text"
                               class="form-control {{ $errors->first('start')?'is-invalid':'' }}"
                               id="inputStart"
                               name="start"
                               placeholder="yyyy-mm-dd HH:MM"
                               value="{{ old('start')??$session->start }}">
                               <div class="invalid-feedback">
                                {{ $errors->first('start') }}
                            </div>
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <label for="inputEnd">End</label>
                        <input type="text"
                               class="form-control {{ $errors->first('end')?'is-invalid':'' }}"
                               id="inputEnd"
                               name="end"
                               placeholder="yyyy-mm-dd HH:MM"
                               value="{{ old('end')??$session->end }}">
                               <div class="invalid-feedback">
                                {{ $errors->first('end') }}
                            </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="textareaDescription">Description</label>
                        <textarea class="form-control {{ $errors->first('description')?'is-invalid':'' }}" id="textareaDescription" name="description" placeholder="" rows="5">{{ old('description')??$session->description }}</textarea>
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    </div>
                </div>

                <hr class="mb-4">
                <button class="btn btn-primary" type="submit">Save session</button>
                <a href="{{ route('campaign.show',$campaign) }}" class="btn btn-link">Cancel</a>
            </form>

@endsection
