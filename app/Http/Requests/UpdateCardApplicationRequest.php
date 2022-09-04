<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCardApplicationRequest extends FormRequest
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
        return [
//            'user_id' => ['required', 'integer', 'exists:users,id'],
            'card_category_id ' => ['required', 'integer', 'exists:card_categories,id'],
            'customer_name' => ['required', 'string'],
            'organization_name' => ['required', 'string'],
            'card_number' => ['required', 'string'],
            'card_type' => ['required', 'in:primary,supply'],
            'client_id' => ['required', 'string'],
            'phone' => ['required', 'string', 'regex:/(01)[2-9]{1}[0-9]{8}/', 'size:11'],
            'refrm' => ['nullable', 'string'],
            'rm_code' => ['nullable', 'string'],
            'status' => ['required', 'in:active,pending,rejected,expired'],
        ];
    }
}
