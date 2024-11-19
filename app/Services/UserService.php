<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ServiceTrait;
use Illuminate\Support\Facades\Hash;

class UserService
{
    use ServiceTrait;

    /** @var User */
    public static $Model = User::CLASS;


    public static function add($name, $password)
    {
        try {

            return User::updateOrCreate(['name' => $name], ['password' => $password]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    public static function login($name, $password)
    {
        try {
            /** @var User $user */
            $user = User::where(['name' => $name])->first();
            if (empty($user)) {
                throw new \Exception('user not exists');
            }
            if (!Hash::check($password, $user->password)) {
                throw new \Exception('password error');
            }

            return $user->createToken($user->id)->plainTextToken;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}
