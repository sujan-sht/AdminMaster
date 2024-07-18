<?php

namespace SujanSht\AdminMaster\Http\Controllers\Auth;

use SujanSht\AdminMaster\Http\Controllers\Controller;
use SujanSht\AdminMaster\Providers\AdminMasterServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(AdminMasterServiceProvider::HOME)
                    : view('auth.verify-email');
    }
}
