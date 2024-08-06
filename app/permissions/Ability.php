<?php

namespace App\permissions;

use App\Models\User;
use Termwind\Components\Ul;

final class Ability
{
    public const TicketCreate = 'ticket:create';
    public const TicketUpdate = 'ticket:update';
    public const TicketReplace = 'ticket:replace';
    public const TicketDelete = 'ticket:delete';

    public const TicketOwnUpdate = 'ticket:own:update';
    public const TicketOwnDelete = 'ticket:own:delete';

    public const UserCreate = 'user:create';
    public const UserUpdate = 'user:update';
    public const UserReplace = 'user:replace';
    public const UserDelete = 'user:delete';

    public static function getAbilities (User $user) {
        if ($user->is_admin) {
            return [
                self::TicketCreate ,
                self::TicketUpdate ,
                self::TicketReplace ,
                self::TicketDelete ,
                self::UserCreate ,
                self::UserUpdate ,
                self::UserDelete ,
                self::UserReplace ,
            ];
        } else {
            return [
                self::TicketCreate,
                self::TicketOwnUpdate,
                self::TicketOwnDelete,
            ];
        }
    }
}
