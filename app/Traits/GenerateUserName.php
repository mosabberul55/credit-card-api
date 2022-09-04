<?php

namespace App\Traits;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

trait GenerateUserName
{
    public static function bootGenerateUserName()
    {

    }

    public static function initializeGenerateUserName()
    {
        static::saving(function ($model) {
            if ($model->name) {
                $model->username = self::generateUserName($model);
            }
        });
    }

    public static function generateUserName($model)
    {
        $splittedName = explode(' ', $model->name);
        if (count($splittedName)) {
            $userNameSubStr = '';
            foreach ($splittedName as $name) {
                $userNameSubStr .= substr($name, 0, 2);
            }
        } else {
            $userNameSubStr = substr($model->name, 0, 3);
        }
        return self::generateNewUserName($userNameSubStr);
    }

    public static function generateNewUserName($userNameSubStr): string
    {
        $number = random_int(1000, 9000);
        $username = '@' . $userNameSubStr . '00' . $number;
        if (self::UsernameExist($username)) {
            return self::generateNewUserName($username);
        }
        return $username;
    }

    public static function UsernameExist($username)
    {
        return self::where(['username' => $username])->exists();
    }
}
