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

    public static function CreateTokenForSetPassword($userEmail):string{
        $key = env('JWT_KEY');

        $payload = array(
            'iss' => 'laravel-token',//token issuar name
            'iat' => time(),//token creation time
            'exp' => time() + 60*10,
            'userEmail' => $userEmail,
        );
        return JWT::encode($payload, $key, 'HS256');
    }

    function VerifyToken($token):string
    {
        try{

            //if the token is null it hepend when the token is normally time out or other reason
            if($token == null){
                return "unauthorized";
            }
            $key = env('JWT_KEY');
            $decoded = JWT::decode($token,new Key($key, 'HS256'));
            return $decoded->userEmail;

        }catch (ExpiredException $e){
            return "unauthorized";
        }
    }
}

