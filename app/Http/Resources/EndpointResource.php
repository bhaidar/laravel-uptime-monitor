<?php

namespace App\Http\Resources;

use App\Enums\EndpointFrequency;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class EndpointResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'location' => $this->location,
            'frequency_label' => EndpointFrequency::from($this->frequency)->label(),
        ];
    }
}
