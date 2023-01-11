<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class EndpointStoreController extends Controller
{
    public function __invoke(Request $request, Site $site)
    {
        $site->endpoints()->create($request->only('location', 'frequency'));
        return back();
    }
}
