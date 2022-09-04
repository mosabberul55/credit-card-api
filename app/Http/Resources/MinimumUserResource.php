<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MinimumUserResource extends JsonResource
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
            'name' => $this->name,
            'username' => $this->username,
            'photo' => $this->photo,
            'phone' => $this->phone,
            'email' => $this->email,
            'type' => $this->type,
            'dob' => $this->dob,
            'approved' => $this->approved,
            'active' => $this->active,
        ];
    }
}
