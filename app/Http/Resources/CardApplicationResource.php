<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CardApplicationResource extends JsonResource
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
            'id' => $this->id,
            'user_id' => $this->user_id ,
            'card_category_id' => $this->card_category_id ,
            'customer_name' => $this->customer_name,
            'organization_name' => $this->organization_name,
            'card_number' => $this->card_number,
            'card_type' => $this->card_type,
            'client_id' => $this->client_id,
            'phone' => $this->phone,
            'refrm' => $this->refrm,
            'rm_code' => $this->rm_code,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'user' => new UserResource($this->whenLoaded('user')),
            'cardCategory' => CardCategoryResource::collection($this->whenLoaded('cardCategory'))
        ];
    }
}
