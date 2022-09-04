<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required_without:phone',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'phone' => ['required_without:email', 'string', 'unique:users,phone', 'regex:/(01)[2-9]{1}[0-9]{8}/', 'size:11'],
            'password' => $this->passwordRules(),
        ])->validate();


        $user = User::create([
            'name' => $input['name'] ?? null,
            'email' => $input['email'] ?? null,
            'phone' => $input['phone'] ?? null,
            'password' => bcrypt($input['password']) ?? null,
            'type' => $input['type'] ?? null,
        ]);
        Auth::login($user);
        return $user;
    }
}
