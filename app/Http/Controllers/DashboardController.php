<?php

namespace App\Http\Controllers;

use App\Enums\EndpointFrequency;
use App\Http\Resources\EndpointFrequencyResource;
use App\Http\Resources\EndpointResource;
use App\Http\Resources\SiteResource;
use App\Models\Site;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request, Site $site): Response
    {
        // Make site default
        $site->update(['default' => true]);

        // Case when no site is passed over
        if (!$site->exists)
        {
            $site = $request->user()->sites()->whereDefault(true)->first() ?? $request->user()->sites()->first();
        }

        // eager load endpoints together with their checks
        $site->loadMissing('endpoints.check');

        return Inertia::render('Dashboard', [
            'site' => SiteResource::make($site),
            'sites' => SiteResource::collection(Site::get()),
            'endpoints' => EndpointResource::collection($site->endpoints),
        ]);
    }
}
