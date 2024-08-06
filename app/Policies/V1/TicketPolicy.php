<?php

namespace App\Policies\V1;

use App\Models\Ticket;
use App\Models\User;
use App\permissions\Ability;

class TicketPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    // who can update ticket.
    public function update(User $user, Ticket $ticket) :bool {
        if ($user->tokenCan(Ability::TicketUpdate)) {
            return true;
        } else if ($user->tokenCan(Ability::TicketOwnUpdate)) {
            return $user->id === $ticket->user_id ;
        }
        return false;
    }
}
