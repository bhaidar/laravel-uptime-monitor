<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteNotificationEmailDestroyRequest;
use App\Models\Site;
use Illuminate\Http\RedirectResponse;

class SiteNotificationEmailDestroyController extends Controller
{
    /**
     * @param SiteNotificationEmailDestroyRequest $request
     * @param Site $site
     * @return RedirectResponse
     */
    public function __invoke(SiteNotificationEmailDestroyRequest $request, Site $site): RedirectResponse
    {
        $site->update([
            'notification_emails' => array_diff($site->notification_emails, [$request->email]),
        ]);
        return back();
    }
}
