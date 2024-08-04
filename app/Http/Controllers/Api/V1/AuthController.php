<?php

namespace App\Http\Controllers\Api\V1;

use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiLoginRequest;

class AuthController extends Controller
{ 
    use ApiResponses;

    public function home():JsonResponse{
        return $this->ok("welcome home");
    }
    // login 
    public function login(ApiLoginRequest $request):JsonResponse {
        return $this->ok("$request->email was login");
    }

    // Register
    public function register(ApiLoginRequest $request):JsonResponse {
        return $this->ok("$request->email was registered.");
    }
}
