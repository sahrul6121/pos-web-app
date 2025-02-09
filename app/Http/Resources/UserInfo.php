<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserInfo extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'displayName' => $this->name,
            'status' => 'online',
            'photoURL' => $this->avatar,
            'userRole' => $this->role->slug,
            'userRoleName' => $this->role->name,
            'about' => 'none',
        ];
    }
}
