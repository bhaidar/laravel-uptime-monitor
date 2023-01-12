<?php

namespace App\Http\Requests;

use App\Enums\EndpointFrequency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class EndpointUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->user()->can('update', $this->endpoint);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'location' => [
                'required',
                Rule::unique('endpoints')->where(fn ($query) => $query->where('site_id', $this->endpoint->site_id)),
            ],
            'frequency' => ['required', new Enum(EndpointFrequency::class)], // validate enum
        ];
    }
}
