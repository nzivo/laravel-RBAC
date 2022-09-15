<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use App\Transformers\UserTransformer;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthController extends Controller
{
    public function currentUser()
    {
        $user = auth()->user()->roles;
        return $user;
    }
    public function login(Request $request)
    {
        $rules = [
            'email' => [
                'required',
                'email',
                'max:255',
            ],
            'password' => [
                'required',
                'string',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ]
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json([
                'validation errors' => $validator-> errors()
            ]);
        }

        $credentials = $request->only('email', 'password');
        try{
            if(!$token = auth()->attempt($credentials)){
                throw new UnauthorizedHttpException('User name or password is invalid');
            }
        } catch(JWTException $e){
            throw $e;
        }
        return $this->respondWithToken($token);
    }

    public function refresh()
    {
        try{
            if(!$token = auth()->getToken()){
                throw new NotFoundHttpException('Token does not exist');
            }
            return $this->respondWithToken(auth()->refresh($token));
        } catch(JWTException $e){
            throw $e;
        }

    }

    public function logout()
    {
        try{
            auth()->logout();
        } catch(JWTException $e){
            throw $e;
        }
        return response()->json(['message' => 'User Logged out successfuly']);
    }

    private function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }
}
