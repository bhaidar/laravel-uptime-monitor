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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'site' => ['required'],
            'email' => ['required'],
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

        $this->mergeIfMissing([
            'site' => $this->site,
            'email' => $this->email,
        ]);
    }
}
