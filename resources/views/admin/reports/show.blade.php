@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.report.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reports.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.id') }}
                        </th>
                        <td>
                            {{ $report->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.file_number') }}
                        </th>
                        <td>
                            {{ $report->file_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.seat') }}
                        </th>
                        <td>
                            {{ $report->seat->seat ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.file_year') }}
                        </th>
                        <td>
                            {{ $report->file_year }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.from') }}
                        </th>
                        <td>
                            {{ $report->from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.from_eng') }}
                        </th>
                        <td>
                            {{ $report->from_eng }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.dept') }}
                        </th>
                        <td>
                            {{ $report->dept->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.received_date') }}
                        </th>
                        <td>
                            {{ $report->received_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.submitted_date') }}
                        </th>
                        <td>
                            {{ $report->submitted_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.subject') }}
                        </th>
                        <td>
                            {{ $report->subject }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.subject_eng') }}
                        </th>
                        <td>
                            {{ $report->subject_eng }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.district') }}
                        </th>
                        <td>
                            {{ $report->district->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.report') }}
                        </th>
                        <td>
                            @foreach($report->report as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reports.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection