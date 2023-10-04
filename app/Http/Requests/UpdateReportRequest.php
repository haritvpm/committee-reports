<?php

namespace App\Http\Requests;

use App\Models\Report;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateReportRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('report_edit');
    }

    public function rules()
    {
        return [
            'file_number' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'seat_id' => [
                'required',
                'integer',
            ],
            'file_year' => [
                'string',
                'required',
            ],
            'from' => [
                'string',
                'required',
            ],
            'from_eng' => [
                'string',
                'nullable',
            ],
            'received_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'submitted_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'subject' => [
                'string',
                'nullable',
            ],
            'subject_eng' => [
                'string',
                'nullable',
            ],
            'report' => [
                'array',
            ],
        ];
    }
}
