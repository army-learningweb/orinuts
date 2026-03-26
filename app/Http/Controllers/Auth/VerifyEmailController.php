<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // Kiểm tra có kích hoạt mail chưa / Nếu chưa trở về trang login yêu cầu xác thực
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('admin.dashboard', absolute: false).'?verified=1');
        }

        // Nếu có xác thực, chuyển unactive thành active
        if ($request->user()->markEmailAsVerified()) {
            User::where('email',$request->user()->email)->update(['is_active' => 'active']);
            event(new Verified($request->user()));
        }

        return redirect()->intended(route('admin.dashboard', absolute: false).'?verified=1');
    }
}
