<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteStoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SiteStoreController extends Controller
{
    /**
     * Handle the incoming request.
     * @param SiteStoreRequest $request
     * @return RedirectResponse
     */
    public function __invoke(SiteStoreRequest $request): RedirectResponse
    {
        // Create the site
        $site = $request->user()->sites()->create($request->only(['domain']));

        return to_route('dashboard', $site);
    }
}
