<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Http\Resources\V1\UserResource;
use App\Http\Controllers\Api\V1\ApiBaseController;
use App\Http\Filters\V1\UserFilter;
use App\Http\Requests\Api\V1\Users\StoreUserRequest;
use App\Http\Requests\Api\V1\Users\UpdateUserRequest;
use App\Traits\ApiResponses;

class UserController extends ApiBaseController
{
    use ApiResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(UserFilter $filters){
        
        return UserResource::collection(User::filter($filters)->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {   
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
