<?php

namespace MichelMelo\JazzRh\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Categories2ApplicantsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'applicant_id' => $this->applicant_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
