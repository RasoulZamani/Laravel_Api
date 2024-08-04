<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

// Trait for handle json responses
trait ApiResponses {
    
    // function for ok response with 200 code
    protected function ok(string $message):JsonResponse{
        return $this->success($message, 200);
    }

    // function for any response that could be consider as success
    protected function success(string $message, int $statusCode = 200):JsonResponse {
        return response()->json([
            "message" => $message,
            "status_code" => $statusCode
        ], $statusCode);
    }
}
