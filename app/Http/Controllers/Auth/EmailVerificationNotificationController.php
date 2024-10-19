<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // return response()->json(['data' => $request->user()], 200);
        if (now()->lt($request->user()->email_verified_expired_at)) {
            return response()->json(['message' => 'Email verification link already sent to your email.'], 200);
        }
        $request->user()->sendEmailVerificationNotification();

        return response()->json(['message' => 'Email verification link sent to your email.'], 200);
    }
}
