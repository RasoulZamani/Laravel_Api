<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\ApiResponses;

class AuthController extends Controller
{ 
    use ApiResponses;
    public function login():JsonResponse {
        return $this->ok("login...");
    }
}
