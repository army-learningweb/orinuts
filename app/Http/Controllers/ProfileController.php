<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('admin.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('admin.profile.edit')->with('status', 'Đã cập nhật thông tin hồ sơ');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password_destroy' => 'required'
        ],
        [
            'required' => ':attribute không để trống'
        ],
        [
            'password_destroy' => 'Mật khẩu'
        ]);

        $password = User::where('name', Auth::user()->name)->first()->password;
        if (Hash::check($request->password_destroy, $password)) {

            $email = User::where('name',Auth::user()->name)->first()->email;
            PasswordResetToken::where('email',$email)->delete();
            User::where('name', Auth::user()->name)->delete();
            $user = $request->user();

            Auth::logout();
            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return Redirect::to('/');
        }else{
            return redirect('admin/profile')->with('destroy_failed','Xóa thất bại, mật khẩu không chính xác');
        }
    }
}
