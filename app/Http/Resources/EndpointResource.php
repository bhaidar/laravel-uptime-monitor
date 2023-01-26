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
            'frequency' => $this->frequency,
            'frequency_label' => EndpointFrequency::from($this->frequency)->label(),
            'latest_check' => CheckResource::make($this->check),
            'url' => $this->url(),
            'site' => SiteResource::make($this->whenLoaded('site')),
            'checks' => CheckResource::collection($this->whenLoaded('checks')),
            'uptimePercentages' => $this->relationLoaded('checks') ? $this->uptimePercentages() : null,
        ];
    }
}
