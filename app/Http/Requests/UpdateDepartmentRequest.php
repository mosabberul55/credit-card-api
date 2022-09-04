<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDepartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->department->id;
        return [
            'name' => ['required', 'string', 'max:191', 'unique:departments,name,' . $id],
            'description' => ['', 'nullable', 'string']
        ];
    }
}
