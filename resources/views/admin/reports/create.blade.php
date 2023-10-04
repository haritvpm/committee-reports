@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.report.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.reports.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="file_number">{{ trans('cruds.report.fields.file_number') }}</label>
                <input class="form-control {{ $errors->has('file_number') ? 'is-invalid' : '' }}" type="number" name="file_number" id="file_number" value="{{ old('file_number', '') }}" step="1" required>
                @if($errors->has('file_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.file_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="seat_id">{{ trans('cruds.report.fields.seat') }}</label>
                <select class="form-control select2 {{ $errors->has('seat') ? 'is-invalid' : '' }}" name="seat_id" id="seat_id" required>
                    @foreach($seats as $id => $entry)
                        <option value="{{ $id }}" {{ old('seat_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('seat'))
                    <div class="invalid-feedback">
                        {{ $errors->first('seat') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.seat_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="file_year">{{ trans('cruds.report.fields.file_year') }}</label>
                <input class="form-control {{ $errors->has('file_year') ? 'is-invalid' : '' }}" type="text" name="file_year" id="file_year" value="{{ old('file_year', '') }}" required>
                @if($errors->has('file_year'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_year') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.file_year_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="from">{{ trans('cruds.report.fields.from') }}</label>
                <input class="form-control {{ $errors->has('from') ? 'is-invalid' : '' }}" type="text" name="from" id="from" value="{{ old('from', '') }}" required>
                @if($errors->has('from'))
                    <div class="invalid-feedback">
                        {{ $errors->first('from') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.from_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="from_eng">{{ trans('cruds.report.fields.from_eng') }}</label>
                <input class="form-control {{ $errors->has('from_eng') ? 'is-invalid' : '' }}" type="text" name="from_eng" id="from_eng" value="{{ old('from_eng', '') }}">
                @if($errors->has('from_eng'))
                    <div class="invalid-feedback">
                        {{ $errors->first('from_eng') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.from_eng_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="dept_id">{{ trans('cruds.report.fields.dept') }}</label>
                <select class="form-control select2 {{ $errors->has('dept') ? 'is-invalid' : '' }}" name="dept_id" id="dept_id">
                    @foreach($depts as $id => $entry)
                        <option value="{{ $id }}" {{ old('dept_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('dept'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dept') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.dept_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="received_date">{{ trans('cruds.report.fields.received_date') }}</label>
                <input class="form-control date {{ $errors->has('received_date') ? 'is-invalid' : '' }}" type="text" name="received_date" id="received_date" value="{{ old('received_date') }}">
                @if($errors->has('received_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('received_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.received_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="submitted_date">{{ trans('cruds.report.fields.submitted_date') }}</label>
                <input class="form-control date {{ $errors->has('submitted_date') ? 'is-invalid' : '' }}" type="text" name="submitted_date" id="submitted_date" value="{{ old('submitted_date') }}">
                @if($errors->has('submitted_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('submitted_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.submitted_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="subject">{{ trans('cruds.report.fields.subject') }}</label>
                <input class="form-control {{ $errors->has('subject') ? 'is-invalid' : '' }}" type="text" name="subject" id="subject" value="{{ old('subject', '') }}">
                @if($errors->has('subject'))
                    <div class="invalid-feedback">
                        {{ $errors->first('subject') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.subject_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="subject_eng">{{ trans('cruds.report.fields.subject_eng') }}</label>
                <input class="form-control {{ $errors->has('subject_eng') ? 'is-invalid' : '' }}" type="text" name="subject_eng" id="subject_eng" value="{{ old('subject_eng', '') }}">
                @if($errors->has('subject_eng'))
                    <div class="invalid-feedback">
                        {{ $errors->first('subject_eng') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.subject_eng_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="district_id">{{ trans('cruds.report.fields.district') }}</label>
                <select class="form-control select2 {{ $errors->has('district') ? 'is-invalid' : '' }}" name="district_id" id="district_id">
                    @foreach($districts as $id => $entry)
                        <option value="{{ $id }}" {{ old('district_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('district'))
                    <div class="invalid-feedback">
                        {{ $errors->first('district') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.district_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="report">{{ trans('cruds.report.fields.report') }}</label>
                <div class="needsclick dropzone {{ $errors->has('report') ? 'is-invalid' : '' }}" id="report-dropzone">
                </div>
                @if($errors->has('report'))
                    <div class="invalid-feedback">
                        {{ $errors->first('report') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.report_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedReportMap = {}
Dropzone.options.reportDropzone = {
    url: '{{ route('admin.reports.storeMedia') }}',
    maxFilesize: 500, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 500
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="report[]" value="' + response.name + '">')
      uploadedReportMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedReportMap[file.name]
      }
      $('form').find('input[name="report[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($report) && $report->report)
          var files =
            {!! json_encode($report->report) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="report[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection