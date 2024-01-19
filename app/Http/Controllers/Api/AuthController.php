<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function auth(Request $request) {
        try{
            if($token = User::auth($request)){
                $data = ["access_token" => $token, "token_type" => "Bearer"];
            } else {
                $data = ["error" => ["auth" => "email or password wrong."]];
            }
            return response()->json($data);
        } catch (Exception $error) {
            return response()->json(["error" => ["auth" => "Server Error"]],500);
        }
    }
}
