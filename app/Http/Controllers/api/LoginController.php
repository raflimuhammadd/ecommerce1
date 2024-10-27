<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $authUser = Auth::user();

                // Check the user's role
                if ($authUser->role === 'admin') {
                    return response()->json([
                        'success' => true,
                        'message' => 'Login Berhasil',
                        'data' => [
                            'token' => $authUser->createToken('auth_token')->plainTextToken,
                            'name' => $authUser->name,
                        ],
                    ]);
                } else {
                    // If the user is not an admin, logout and return an error response
                    Auth::logout();

                    throw ValidationException::withMessages([
                        'email' => ['Cek kembali email dan password anda'],
                    ]);
                }
            } else {
                throw ValidationException::withMessages([
                    'email' => ['Cek kembali email dan password anda'],
                ]);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors(),
            ]);
        }
    }
}
