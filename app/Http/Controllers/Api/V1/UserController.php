<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        try {
            $name = $request->input('username', 0);
            $password = $request->input('password', 0);
            if (!$name || !$password) {
                throw new \Exception('username or password can not empty');
            }

            $data = [
                'token' => UserService::login($name, $password)
            ];

            return success($data);
        } catch (\Exception $e) {
            return failed($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function info(Request $request)
    {
        try {
            $user = auth()->user();

            $data = [
                'roles' => ['admin'],
                'introduction' => $user->intro ?? '',
                'avatar' => $user->avatar ?? '',
                'name' => $user->name ?? '',
            ];

            return success($data);
        } catch (\Exception $e) {
            return failed($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();

            return success("success");
        } catch (\Exception $e) {
            return failed($e->getMessage(), $e->getCode());
        }
    }
}
