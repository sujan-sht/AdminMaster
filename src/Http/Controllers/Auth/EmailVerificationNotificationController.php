<?php

namespace SujanSht\AdminMaster\Http\Controllers\Auth;

use SujanSht\AdminMaster\Http\Controllers\Controller;
use SujanSht\AdminMaster\Providers\AdminMasterServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(AdminMasterServiceProvider::HOME);
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
