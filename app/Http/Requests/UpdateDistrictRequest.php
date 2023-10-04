<?php

namespace App\Http\Requests;

use App\Models\District;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDistrictRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('district_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:districts,name,' . request()->route('district')->id,
            ],
            'name_mal' => [
                'string',
                'required',
                'unique:districts,name_mal,' . request()->route('district')->id,
            ],
        ];
    }
}
