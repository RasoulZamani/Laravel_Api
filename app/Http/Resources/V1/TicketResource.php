<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'ticket',
            'id' => $this->id,
            'attributes' => [
                'title' => $this->title,
                'status' => $this->status,
                'description' => $this->when(!$request->routeIs(['tickets.index', 'users.tickets.index']),
                    $this->description,
                ),
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at,
            ],
            
            'relationships' => [
                'author' => [
                    'type' => 'user',
                    'id' => $this->user_id,
                ],
            ],

            'includes' => [
                'user' => new UserResource($this->whenLoaded('user')),
            ],
            'links' => [
                'self' => route('tickets.show', ['ticket'=>$this->id])
            ],
            // 'meta' => [],
        ];
    }
}
