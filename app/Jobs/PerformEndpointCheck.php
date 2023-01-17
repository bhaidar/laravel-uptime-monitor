<?php

namespace App\Jobs;

use App\Models\Endpoint;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PerformEndpointCheck implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public Endpoint $endpoint)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        try {
            $response = Http::get($this->endpoint->url());
        } catch (Exception)
        {}

        $this->endpoint->checks()->create([
            'response_code' => $response->status(),
            'response_body' => !$response->successful() ? $response->body() : '',
        ]);

        $this->endpoint->update([
            'next_check' => now()->addSeconds($this->endpoint->frequency),
        ]);
    }
}
