<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteNotificationEmailStoreRequest;
use App\Models\Site;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;

class SiteNotificationEmailStoreController extends Controller
{
    public function __invoke(SiteNotificationEmailStoreRequest $request, Site $site): RedirectResponse
    {
        $site->update([ // add new emails at top
           'notification_emails' => Arr::prepend($site->notification_emails ?? [], $request->email),
        ]);
        return back();
    }
}
