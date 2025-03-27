<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenVerificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //here i recived token by header
        $token = $request->cookie('token');

        $result = (new JWTToken)->VerifyToken($token);

        if($result == "unauthorized"){
            return redirect('/login');
        }
        else{
            //internal password return by JWTToken
            $request->headers->set('email', $result->userEmail);
            $request->headers->set('id', $result->userId);
            return $next($request);
        }
    }
}
