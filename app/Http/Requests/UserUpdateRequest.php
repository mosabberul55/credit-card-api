<?php

namespace App\Http\Requests;

use App\Actions\Fortify\PasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
        $id = $this->user->id;
        return [
            'name' => ['required', 'string'],
//            'photo' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10000'],
            'phone' => ['required', 'string', 'regex:/(01)[2-9]{1}[0-9]{8}/', 'size:11', 'unique:users,phone,'.$id],
            'email' => ['required', 'email', 'unique:users,email,'.$id],
            'password' => ['string', new PasswordRule],
            'department_id' => ['required', 'integer', 'exists:departments,id'],
            'dob' => ['nullable', 'date'],
            'gender' => ['nullable', 'in:male,female,others'],
            'type' => ['in:admin,employee'],
        ];
    }
}
