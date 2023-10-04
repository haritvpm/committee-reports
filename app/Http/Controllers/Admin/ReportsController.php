<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyReportRequest;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Department;
use App\Models\District;
use App\Models\Report;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ReportsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reports = Report::with(['seat', 'dept', 'district', 'media'])->get();

        return view('admin.reports.index', compact('reports'));
    }

    public function create()
    {
        abort_if(Gate::denies('report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $seats = User::pluck('seat', 'id')->prepend(trans('global.pleaseSelect'), '');

        $depts = Department::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.reports.create', compact('depts', 'districts', 'seats'));
    }

    public function store(StoreReportRequest $request)
    {
        $report = Report::create($request->all());

        foreach ($request->input('report', []) as $file) {
            $report->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('report');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $report->id]);
        }

        return redirect()->route('admin.reports.index');
    }

    public function edit(Report $report)
    {
        abort_if(Gate::denies('report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $seats = User::pluck('seat', 'id')->prepend(trans('global.pleaseSelect'), '');

        $depts = Department::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $report->load('seat', 'dept', 'district');

        return view('admin.reports.edit', compact('depts', 'districts', 'report', 'seats'));
    }

    public function update(UpdateReportRequest $request, Report $report)
    {
        $report->update($request->all());

        if (count($report->report) > 0) {
            foreach ($report->report as $media) {
                if (! in_array($media->file_name, $request->input('report', []))) {
                    $media->delete();
                }
            }
        }
        $media = $report->report->pluck('file_name')->toArray();
        foreach ($request->input('report', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $report->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('report');
            }
        }

        return redirect()->route('admin.reports.index');
    }

    public function show(Report $report)
    {
        abort_if(Gate::denies('report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $report->load('seat', 'dept', 'district');

        return view('admin.reports.show', compact('report'));
    }

    public function destroy(Report $report)
    {
        abort_if(Gate::denies('report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $report->delete();

        return back();
    }

    public function massDestroy(MassDestroyReportRequest $request)
    {
        $reports = Report::find(request('ids'));

        foreach ($reports as $report) {
            $report->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('report_create') && Gate::denies('report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Report();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
