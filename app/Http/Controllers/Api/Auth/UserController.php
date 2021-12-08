<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show()
    {
        return response()->json([
            'data' => Auth::user()
        ], 200);
    }

    public function update(Request $request)
    {
        try {
            $update = $request->all();
            $user = User::findOrFail(Auth::id());
            $user->update($update);
            return response()->json([
                'message' => 'data updated',
                'data' => $update
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'message' => 'Server error'
            ], 500);
        }
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            $user = Auth::user();
            if (Hash::check($request->new_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
                return response()->json([
                    'message' => 'password updated'
                ], 200);
            }
            return response()->json([
                'message' => 'Wrong password'
            ], 500);
        } catch (Exception $ex) {
            return response()->json([
                'message' => 'Server error'
            ], 500);
        }
    }
}
