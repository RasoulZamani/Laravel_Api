<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiLoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\ApiResponses;

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
