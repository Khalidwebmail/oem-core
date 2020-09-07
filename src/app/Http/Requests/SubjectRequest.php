<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'dept_id' => 'required',
            'name' => 'required|unique:subjects',
            'slug' => 'required|unique:subjects',
            'code' => 'required|unique:subjects',
            'credit_hour' => 'required',
        ];
    }
}
