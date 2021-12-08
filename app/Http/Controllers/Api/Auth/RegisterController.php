<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            $user = new User($request->all());
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json([
                'message' => 'Successfully registered',
                'data' => $user
            ], 201);
        } catch (Exception $ex) {
            return response()->json([
                'message' => 'Server error'
            ], 500);
        }
    }
}
