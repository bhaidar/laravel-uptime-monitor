<?php

namespace App\Http\Controllers;

use App\Http\Requests\EndpointShowRequest;
use App\Http\Resources\EndpointResource;
use App\Models\Endpoint;
use Inertia\Inertia;
use Inertia\Response;

class EndpointIndexController extends Controller
{
    public function __invoke(EndpointShowRequest $request, Endpoint $endpoint): Response
    {
        $endpoint->load(['site', 'checks']);

        return Inertia::render('Endpoint', [
            'endpoint' => EndpointResource::make($endpoint),
        ]);
    }
}
