<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Rules\Password;

class PasswordRule extends Password
{
    protected $length = 6;
}
