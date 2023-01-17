<?php

namespace App\Http\Controllers;

use App\Http\Resources\EndpointResource;
use App\Models\Endpoint;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EndpointIndexController extends Controller
{
    public function __invoke(Request $request, Endpoint $endpoint): Response
    {
        // Authorize

        return Inertia::render('Endpoint', [
            'endpoint' => EndpointResource::make($endpoint),
        ]);
    }
}
