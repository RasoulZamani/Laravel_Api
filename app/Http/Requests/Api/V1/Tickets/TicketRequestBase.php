<?php

namespace App\Http\Requests\Api\V1\Tickets;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequestBase extends FormRequest
{
    // map attributes from request to model
    public function mappedAttributes(){
        $mapAttributes = [
            'data.attributes.title' => 'title',
            'data.attributes.description' => 'description',
            'data.attributes.status' => 'status',
            'data.attributes.createdAt' => 'created_at',
            'data.attributes.updatedAt' => 'updated_at',
            'data.relationships.author.id' =>'user_id'
        ];
        $attributesToUpdate = [] ;
        foreach ($mapAttributes as $key=>$attribute) {
            if ($this->has($key)) {
                $attributesToUpdate[$attribute] = $this->input($key);
            }
        }
        return $attributesToUpdate;
    }
    // custom messages
    public function messages(): array {
        return [
          'data.attributes.status' => 'data.attribute.status is invalid, please use one of these statuses: pending, answered, canceled',  
        ];

    }
}
