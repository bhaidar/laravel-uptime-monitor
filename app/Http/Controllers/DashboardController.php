<?php

namespace App\Http\Controllers;

use App\Http\Resources\EndpointResource;
use App\Http\Resources\SiteResource;
use App\Models\Endpoint;
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
     * @param Site $site
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

        if (!$site)
        {
            return Inertia::render('Dashboard');
        }

        // eager load endpoints together with their checks
        $site->loadMissing(['endpoints.checks', 'endpoints.check']);

        return Inertia::render('Dashboard', [
            'site' => SiteResource::make($site),
            'endpoints' => EndpointResource::collection(
                $site->endpoints
                    ->map(function (Endpoint $endpoint) use($site) { // not to load site again when calling site->url() on each Endoint
                        return $endpoint->setRelation('site', $site);
                    })
            ),
        ]);
    }
}
