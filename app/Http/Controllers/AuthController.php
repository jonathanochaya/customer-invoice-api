<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // setup default credentials and tokens for API access
    public function setup()
    {
        $credentials = [
            'email' => config('app.api_email'),
            'password' => config('app.api_password')
        ];

        if(!auth()->attempt($credentials)) {
            $user = User::create([
                'name' => config('app.api_username'),
                'email' => config('app.api_email'),
                'password' => bcrypt(config('app.api_password')),
            ]);

            if(auth()->attempt($credentials)) {
                return [
                    'admin' => $user->createToken('admin-token', ['create', 'update', 'delete'])->plainTextToken,
                    'update' => $user->createToken('update-token', ['create', 'update'])->plainTextToken,
                    'basic' => $user->createToken('basic-token', ['create'])->plainTextToken,
                ];
            }
        }
    }

    public function logout()
    {
        if(auth()->hasUser()) {
            auth()->user()->tokens()->delete();
            auth()->logout();
        };
    }
}
