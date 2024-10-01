<?php
namespace App\Middleware;

use Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Responce;

class AuthMiddleware {
    public function handle(Request $request, callable $next){
        $authorizationHeader = $request->headers->get('Authorization');
        if(!$authorizationHeader){
            return new Response(json_encode(['error'=>'No token provided']),401);
        }
        list($jwt)=sscanf($authorizationHeader,'Bearer %s');
        if(!$jwt){
            return new Response(json_encode(['error'=>'Invalid token']),401);
        }

        try{
            $decoded = JWT::decode($jwt,$_ENV['JWT_SECRET'],['HS256']);
            $request->attributes->set('user',$decoded);
        } catch(\Exception $e) {
            return new Response(json_encode(['error'=>'Invalid token']),401);
        }

        return $next($request);
    }
}
?>