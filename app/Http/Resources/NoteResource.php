<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $user = User::find($this->user_id);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'user' => [
                'name' => $user->name,
                'email' => $user->email
            ]
        ];
    }
}
