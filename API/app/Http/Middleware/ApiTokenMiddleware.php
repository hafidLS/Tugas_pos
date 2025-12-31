<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Pengguna;

class ApiTokenMiddleware
{  
    public function handle($request, Closure $next)
    {
        $header = $request->header('Authorization');

        if (! $header || ! str_starts_with($header, 'Bearer ')) {
            return response()->json([
                'message' => 'Token tidak ada'
            ], 401);
        }

        $token = substr($header, 7);

        $pengguna = Pengguna::where(
            'api_token',
            hash('sha256', $token)
        )->first();

        if (! $pengguna) {
            return response()->json([
                'message' => 'Token tidak valid'
            ], 401);
        }
        
          if ($pengguna->token_expired_at && $pengguna->token_expired_at < now()) {
            return response()->json([
                'message' => 'Token expired'
            ], 401);
        }

        // sisipkan user ke request
        $request->merge([
            'auth_pengguna' => $pengguna
        ]);

        return $next($request);
    }
}
