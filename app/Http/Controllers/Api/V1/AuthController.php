<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\permissions\Ability;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\V1\Users\ApiLoginRequest;

class AuthController extends Controller
{ 
    use ApiResponses;

    public function home():JsonResponse{
        return $this->ok("welcome home");
    }

    // login 
    public function login(ApiLoginRequest $request):JsonResponse {
        $request->validated($request->all());

        if (!Auth::attempt($request->only('email','password'))) {
            return $this->error($message="Invalid credentials", $statusCode=401);
        }

        $user = User::where('email',$request->email)->first();

        return $this->ok($message="Authenticated", $data=[
            'token' => $user->createToken(
                'API token for' . $user->email,
                Ability::getAbilities($user), 
                now()->addMonth()
                )->plainTextToken
        ]);
        
    }

    // Log out
    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return $this->ok("You logged out! See you soon:)");
    }

    // Register
    public function register(ApiLoginRequest $request):JsonResponse {
        return $this->ok("$request->email was registered.");
    }
}
