<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function register(UserStoreRequest $request)
    {
        $data = $request->only(['phone', 'email', 'name', 'password', 'password_confirmation']);
        unset($data['type']);
        $data['type'] = 'student';
        $user = (new CreateNewUser())->create($data);
        // auth()->login($user);
        $token = $user->createToken('web')->plainTextToken;
        return response(['token' => $token, 'user' => new UserResource($user)]);
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required_without:phone|exists:users|email',
            'phone' => 'required_without:email|exists:users|regex:/(01)[3-9]{1}[0-9]{8}/|size:11',
            'password' => 'required|min:6',
        ];

        $this->validate($request, $rules);

        $user = User::when($request->phone, function ($query) use ($request) {
            $query->where('phone', $request->phone);
        })->when($request->email, function ($query) use ($request) {
            $query->where('email', $request->email);
        })->first();
        if ($user and Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $token = $user->createToken($user->name)->plainTextToken;
            return response(['token' => $token, 'user' => new UserResource($user)]);
        }

        return response('Invalid credentials', Response::HTTP_UNAUTHORIZED);
    }

    public function user(): \Illuminate\Http\JsonResponse
    {
        return response()->json(new UserResource (request()->user()));
    }
}
