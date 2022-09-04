<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCardCategoryRequest extends FormRequest
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
            'name' => ['string', 'max:191', Rule::unique('card_categories', 'name')
                ->where(function ($query) {
                    return $query->whereNull('deleted_at');
                })
            ],
            'description' => [ 'nullable', 'string']
        ];
    }
}
