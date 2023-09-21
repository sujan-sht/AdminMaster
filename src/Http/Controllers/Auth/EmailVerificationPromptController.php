<?php

namespace SujanSht\LaraAdmin\Http\Controllers\Auth;

use SujanSht\LaraAdmin\Http\Controllers\Controller;
use SujanSht\LaraAdmin\Providers\LaraAdminServiceProvider;
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
                    ? redirect()->intended(LaraAdminServiceProvider::HOME)
                    : view('auth.verify-email');
    }
}
