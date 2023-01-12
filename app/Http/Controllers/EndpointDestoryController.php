<?php

namespace App\Http\Controllers;

use App\Models\Endpoint;
use Illuminate\Http\Request;

class EndpointDestoryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param Endpoint $endpoint
     * @return void
     */
    public function __invoke(Request $request, Endpoint $endpoint)
    {
        $endpoint->delete();
    }
}
