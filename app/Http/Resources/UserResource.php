<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'department_id' => $this->department_id,
            'photo' => $this->photo,
            'phone' => $this->phone,
            'email' => $this->email,
            'gender' => $this->gender,
            'dob' => $this->dob ? Carbon::parse($this->dob)->toDateString() : '',
            'approved' => $this->approved,
            'active' => $this->active,
            'type' => $this->type,
        ];
    }
}
