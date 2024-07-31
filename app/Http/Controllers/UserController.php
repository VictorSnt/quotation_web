<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Adiciona um novo usuário.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */

    public function find(User $user)
    {
        return response()->json($user, 200);
    }


    /**
     * Adiciona um novo usuário.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'cnpj' => 'required|string|max:25|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cnpj' => $request->cnpj,
            'password' => Hash::make($request->password),
        ]);
        $response = [
            'message' => 'User successfully registered',
            'user' => $user
        ];
        return response()->json($response, 201);
    }
};