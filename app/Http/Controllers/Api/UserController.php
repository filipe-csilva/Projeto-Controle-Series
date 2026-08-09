<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\password;

class UserController extends Controller
{
    public function store(Request $request) {
        $credentials = $request->only('email', 'password');
        // $user = User::whereEmail($credentials['email'])->first();
        // if($user === null){return response()->json('User is not found', 404);};
        // if(Hash::check($credentials['password'], $user.password) === false){
        //     return response()->json('Unauthorized', 401);
        // };
        if(Auth::attempt($credentials) === false){return response()->json('Unauthorized', 401);}

        $user = Auth::user();
        $token = $user->createToken('token');

        return response()->json($token->plainTextToken);
    }
}
