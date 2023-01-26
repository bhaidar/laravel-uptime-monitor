<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteDestroyRequest;
use App\Models\Site;
use Illuminate\Http\RedirectResponse;

class SiteDestroyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param SiteDestroyRequest $request
     * @param Site $site
     * @return RedirectResponse
     */
    public function __invoke(SiteDestroyRequest $request, Site $site): RedirectResponse
    {
        // Based on the migrations:
        // When a site is deleted, delete cascades and deletes all endpoints
        // When an endpoint is deleted, delete cascades and deletes all checks
        $site->delete();

        return to_route('dashboard');
    }
}
