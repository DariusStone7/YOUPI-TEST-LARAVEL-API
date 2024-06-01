<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\auth\LoginRequest;
use App\Http\Requests\auth\LogoutRequest;
use App\Http\Requests\auth\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){

        try{
            $user = User::create($request->validated());
        
            return response()->json([
                'status_code' => 200,
                'message' => 'utilisateur créé avec succès',
                'user' => $user,
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status_code' => 500,
                'message' => 'utilisateur non créé. une erreur est survenue',
            ]);
        }
        
    }

    public function login(LoginRequest $request){

        try{
            $user = User::where([['email', $request->email], ['password', $request->password]])->first();
            
            // if(auth()->attempt($request->validated())){
            if(isset($user)){
                // $user = auth()->user();

                $token = $user->createToken('SECRET_KEY')->plainTextToken;

                return response()->json([
                    'status_code' => 200,
                    'message' => 'utilisateur connecté avec succès',
                    'user' => $user,
                    'token' => $token,
                ]);
            }

            return response()->json([
                'status_code' => 404,
                'message' => 'cet utilisateur n\'existe pas',
                'user' => null,
            ]);

        }
        catch(Exception $e){
            return response()->json([
                'status_code' => 500,
                'message' => 'Echec de la connexion. une erreur est survenue',
            ]);
        }
    }

    public function logout(){
        
    }
}
