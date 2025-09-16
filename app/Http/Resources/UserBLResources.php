<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserBLResources extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'role' => $this->role,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'no_wa' => $this->no_wa,
            'hwid' => $this->hwid,
            'status_account' => $this->status_account,
            'last_login_at' => $this->last_login_at,
            'last_login_ip' => $this->last_login_ip,
            'active_until' => $this->active_until ? Carbon::parse($this->active_until)->format('Y-m-d H:i:s') : null,
            // 'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            // 'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
