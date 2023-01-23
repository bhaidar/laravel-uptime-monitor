<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class SiteNotificationEmailStoreController extends Controller
{
    public function __invoke(Request $request, Site $site)
    {
        dd($request->email);
    }
}
