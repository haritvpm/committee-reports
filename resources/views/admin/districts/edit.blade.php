@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.district.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.districts.update", [$district->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.district.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $district->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.district.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name_mal">{{ trans('cruds.district.fields.name_mal') }}</label>
                <input class="form-control {{ $errors->has('name_mal') ? 'is-invalid' : '' }}" type="text" name="name_mal" id="name_mal" value="{{ old('name_mal', $district->name_mal) }}" required>
                @if($errors->has('name_mal'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_mal') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.district.fields.name_mal_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection