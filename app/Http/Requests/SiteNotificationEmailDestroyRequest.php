<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteNotificationEmailDestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->user()->can('destroyNotificationChannels', $this->site);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        // Add the url parameter site into the validation data
        // from a route such as /sites/{site}/

//        $this->mergeIfMissing([
//            'email' => $this->email,
//        ]);
    }
}
