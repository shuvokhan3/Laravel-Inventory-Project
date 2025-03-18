<?php

namespace App\Helper;

use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken{
    public  static function CreateToken($userEmail):string
    {
        $key = env('JWT_KEY');

        $payload = array(
            'iss' => 'laravel-token',//token issuar name
            'iat' => time(),//token creation time
            'exp' => time() + 3600,//expare time of this token
            'userEmail' => $userEmail, // the owner of this token
        );


        return JWT::encode($payload, $key , 'HS256');

    }

    function VerifyToken($token)
    {
        try{

            $key = env('JWT_KEY');
            $decoded = JWT::decode($token,new Key($key, 'HS256'));
            return $decoded->userEmail;

        }catch (ExpiredException $e){
            return "unauthorized";
        }
    }
}

