<?php

namespace Apps\Middlewares;

class AuthMiddleware
{
    public function __invoke($request, $response, $next) {
        // Check the session

        // Validate the JWT

        return $next($request, $response);
    }
}
