<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SiteStoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     */
    public function __invoke(Request $request): RedirectResponse
    {
        // Create the site
        $site = $request->user()->sites()->create($request->only(['domain']));

        return to_route('dashboard', $site);
    }
}
