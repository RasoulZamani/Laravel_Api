<?php

namespace App\Http\Requests\Api\V1\Tickets;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Api\V1\Tickets\TicketRequestBase;

class ReplaceTicketRequest extends TicketRequestBase
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'data.attributes.title' => ['required','string'],
            'data.attributes.description' => ['required','string'],
            'data.attributes.status' => ['required','string', 'in:pending,answered,canceled'],
            'data.relationships.author.id' => ['required','integer']
        ];
        
        return $rules;
    }

}
