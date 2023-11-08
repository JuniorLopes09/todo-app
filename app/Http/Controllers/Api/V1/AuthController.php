<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\LoginRequest;
use App\Http\Requests\V1\Auth\StoreUserRequest;
use App\Http\Resources\V1\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use \Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request): UserResource
    {
        return new UserResource(User::create($request->all()));
    }

    public function login(LoginRequest $request): JsonResponse {
        if (Auth::attempt($request->all()))
        {
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;

            return response()->json(['token' => $token], Response::HTTP_OK);
        }

        return response()->json(['error' => 'Usuário ou senha inválidos'], Response::HTTP_UNAUTHORIZED);
    }

    public function logout(Request $request): void
    {
        $request->user()->tokens()->delete();
    }
}
