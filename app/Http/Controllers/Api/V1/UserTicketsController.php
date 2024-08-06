<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Resources\V1\TicketResource;
use App\Http\Controllers\Api\V1\ApiBaseController;
use App\Http\Filters\V1\TicketFilter;

class UserTicketsController extends ApiBaseController
{
    public function index($user_id, TicketFilter $filters) {
        return TicketResource::collection(
            Ticket::where('user_id',$user_id)->filter($filters)->paginate()
        );
    }
}
