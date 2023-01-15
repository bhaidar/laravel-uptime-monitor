<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class CheckResource extends JsonResource
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
            'response_code' => $this->response_code,
            'response_body' => $this->response_body,
            'is_successful' => $this->isSuccessful(),
            'status_text' => $this->statusText(),
            'created_at' => DateTimeResource::make($this->created_at),
        ];
    }
}
