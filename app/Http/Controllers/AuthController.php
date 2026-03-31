<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator; 
class AuthController extends Controller
{
    //API 
    public function registerApi(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255', 
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed', 
                'errors'  => $validator->errors()
            ], 422); 
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);


        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success'      => true,
            'message'      => 'User registered successfully',
            'data'         => [ 
                'user'         => $user,
                'access_token' => $token,
                'token_type'   => 'Bearer',
            ]
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Credenciais inválidas.'
            ], 401);
        }

        // Limpa tokens antigos para segurança
        $user->tokens()->delete();
        
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success'      => true,
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user'         => $user
        ]);
    }

    //WEB

    public function registerWeb(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);

        return redirect()->intended('dashboard');
    }

    public function loginWeb(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas não coincidem.',
        ])->onlyInput('email');
    }

    public function logout(Request $request) 
    {
        // API: Invalida o token atual 
        if ($request->bearerToken()) {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['success' => true, 'message' => 'Token revogado.']);
        }

        // Web
        Auth::logout(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 

        return redirect('/login'); 
    }
}