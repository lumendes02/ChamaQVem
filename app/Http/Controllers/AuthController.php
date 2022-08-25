<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function cadastro(Request $request) {
        $fields = $request->validate([
            'nome' => 'required|string',
            'login' => 'required|string',
            'email' => 'required|string',
            'cpf' => 'required|string',
            'telefone' => 'required|string',
            'idtipousuario' => 'required|integer',
            'senha' => 'required|string'
        ]);


        $user = Usuario::create([
            'nome' => $fields['nome'],
            'login' => $fields['login'],
            'senha' => bcrypt($fields['senha']),
            'email' => $fields['email'],
            'cpf' => $fields['cpf'],
            'telefone' => $fields['telefone'],
            'idtipousuario' => $fields['idtipousuario']
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'login' => 'required|string',
            'senha' => 'required|string'
        ]);


        // Check email
        $user = Usuario::where('login', $fields['login'])->first();

        // Check password
        if(!$user || !Hash::check($fields['senha'], $user->senha)) {
            return response([
                'message' => 'Senha ou Login ruins.'
            ], 401);
        }

      
        // dd($user);die;
        $token = $user->createToken('myapptoken2')->plainTextToken;
        
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        $user = Usuario::where('login', $request['login'])->first();
        $user->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
