<?php

namespace App\Http\Controllers;

use App\Http\Requests\EndpointDestroyRequest;
use App\Models\Endpoint;

class EndpointDestroyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param EndpointDestroyRequest $request
     * @param Endpoint $endpoint
     * @return void
     */
    public function __invoke(EndpointDestroyRequest $request, Endpoint $endpoint): void
    {
        $endpoint->delete();
    }
}
