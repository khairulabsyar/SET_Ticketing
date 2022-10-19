<?php

namespace App\Http\Resources;

use App\Models\Ticket;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'username' => $this->user->first_name,
            'priority' => $this->priority->priority,
            'status' => $this->status->status,
            'category' => $this->category->category_type,
            'developer' => $this->developer?->first_name,
        ];
    }
}