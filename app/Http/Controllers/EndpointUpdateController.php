<?php

namespace App\Http\Controllers;

use App\Http\Requests\EndpointUpdateRequest;
use App\Models\Endpoint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EndpointUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param EndpointUpdateRequest $request
     * @param Endpoint $endpoint
     * @return RedirectResponse
     */
    public function __invoke(EndpointUpdateRequest $request, Endpoint $endpoint): RedirectResponse
    {
        $endpoint->update($request->only('location', 'frequency'));
        return back();
    }
}
