<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

// Trait for handle json responses
trait ApiResponses {
    

    // function for any response that could be consider as success
    protected function success(string $message, array $data =[], int $statusCode = 200):JsonResponse {
        return response()->json([
            "message" => $message,
            "data" => $data,
            "status_code" => $statusCode
        ], $statusCode);
    }
    
    // function for any response that could be consider as failed
    protected function error(string $message, int $statusCode = 400):JsonResponse {
        return response()->json([
            "message" => $message,
            "status_code" => $statusCode
        ], $statusCode);
    }

    // function for ok response with 200 code
    protected function ok(string $message, array $data =[]):JsonResponse{
        return $this->success($message, $data, 200);
    }
}
