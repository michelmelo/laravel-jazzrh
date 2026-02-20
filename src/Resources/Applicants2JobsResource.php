<?php

namespace MichelMelo\JazzRh\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Applicants2JobsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'applicant_id' => $this->applicant_id,
            'job_id' => $this->job_id,
            'status' => $this->status,
            'applied_at' => $this->applied_at,
            'hired_at' => $this->hired_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
