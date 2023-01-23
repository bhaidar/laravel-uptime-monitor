<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SiteNotificationEmailStoreController extends Controller
{
    public function __invoke(Request $request, Site $site): RedirectResponse
    {
        $site->update([
           'notification_emails' => Arr::prepend($site->notification_emails ?? [], $request->email),
        ]);
        return back();
    }
}
