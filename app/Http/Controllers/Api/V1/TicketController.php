<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Policies\V1\TicketPolicy;
use App\Http\Filters\V1\TicketFilter;
use App\Http\Resources\V1\TicketResource;
use App\Http\Controllers\Api\V1\ApiBaseController;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Requests\Api\V1\Tickets\StoreTicketRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Api\V1\Tickets\UpdateTicketRequest;
use App\Http\Requests\Api\V1\Tickets\ReplaceTicketRequest;

class TicketController extends ApiBaseController
{   
    protected $policyClass = TicketPolicy::class;
    /**
     * Display a listing of the resource.
     */
    public function index(TicketFilter $filters)
    {   
        return TicketResource::collection(Ticket::filter($filters)->paginate());
        // if ($this->include('user')) {
        //     return TicketResource::collection(Ticket::with('user')->paginate());
        // }

        // return TicketResource::collection(Ticket::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        // check user_id existence in users table
        try {
            $user = User::findOrFail($request->input('data.relationships.author.id'));
        } catch (ModelNotFoundException $exception) {
            return $this->ok("This user dose not exist in db.", [
                "error" => "provided user_id as author, does not exist."
            ]);
             // Notice that for security issue, we return status code of 200 and error will be shown in data payload.
            // in order to hackers can not find vulnerability in site with non 200 responses
        }

        // save in db
        // $createdTicket = Ticket::create([
        //     'title' => $request->input('data.attributes.title'),
        //     'description' => $request->input('data.attributes.description'),
        //     'status' => $request->input('data.attributes.status'),
        //     'user_id' => $request->input('data.relationships.author.id')

        // ]);
        $createdTicket = Ticket::create($request->mappedAttributes());
        return new TicketResource($createdTicket);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        if ($this->include('user')) {
            return new TicketResource($ticket->load('user'));
        }
        return new TicketResource($ticket);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        //PATCH 
        try {
            // Policy
            $this->isAble('update', $ticket);

            $ticket->update($request->mappedAttributes());
            return new TicketResource($ticket);

        } catch (AuthorizationException $exc) {
            return $this->error("You are not authorized to update this resource!");
        }
    }

    /**
     * Update all attributes of the specified resource in storage.
     */
    public function replace(ReplaceTicketRequest $request, Ticket $ticket)
    {
        //PUT 
        // $ticket->update([
        //     'title' => $request->input('data.attributes.title'),
        //     'description' => $request->input('data.attributes.description'),
        //     'status' => $request->input('data.attributes.status'),
        //     'user_id' => $request->input('data.relationships.author.id')
        // ]);
        $ticket->update($request->mappedAttributes());
        return new TicketResource($ticket);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        // if you want you can first find ticket by ticket_id and
        // send manual error for not found tickets for more security(because model-bind returns more data)
        // however i prefer this simple aproach:
        $ticket->delete();
        return $this->ok("The ticket deleted successfully.");
    }
}
