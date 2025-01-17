<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicCSVResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->user->name,
            'phone' => $this->phone,
            'location' => $this->location->title,
            'specialty' => $this->specialty->title,
            'verified at' => isset($this->verified_at) ? $this->verified_at : 'N/V',
            'created at' => $this->created_at,
            'updated at' => $this->updated_at,
        ];
    }
}
