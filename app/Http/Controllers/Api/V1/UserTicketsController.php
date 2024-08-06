<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Filters\V1\TicketFilter;
use App\Http\Resources\V1\TicketResource;
use App\Http\Controllers\Api\V1\ApiBaseController;
use App\Http\Requests\Api\V1\Tickets\StoreTicketRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserTicketsController extends ApiBaseController
{   
    /**
     * Show tickets created by this user
     */
    public function index($user_id, TicketFilter $filters) {
        return TicketResource::collection(
            Ticket::where('user_id', $user_id)->filter($filters)->paginate()
        );
    }

    /**
     * Store a newly created ticket by this user in storage.
     */
    public function store(StoreTicketRequest $request)
    {
         
        // save in db
        $createdTicket = Ticket::create([
            'title' => $request->input('data.attributes.title'),
            'description' => $request->input('data.attributes.description'),
            'status' => $request->input('data.attributes.status'),
            'user_id' => $request->input('data.relationships.author.id')

        ]);
        return new TicketResource($createdTicket);
    }
}
