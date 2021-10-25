<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->setView('settings');
        $this->setRoute('settings');
        $this->breadcrumbs[] = ['name' => 'Settings', 'url' => route('user.index')];
    }

    /**
     * Page for changing user's Password.
     */
    public function password()
    {
        $this->header();

        $this->breadcrumbs[] = ['name' => 'Password', 'url' => route('user.settings.password')];

        return $this->view('password');
    }

    /**
     * Handle Password Changing Request.
     */
    public function passwordPost(Request $request)
    {
        $request->validate([
            'current_password' => 'bail|required',
            'new_password' => 'bail|required|min:6|different:current_password|confirmed',
        ]);

        $this->user = auth()->user();
        $hasher = app('hash');

        if ($hasher->check($request->current_password, $this->user->password)) {
            $this->user->password = bcrypt($request->new_password);
            if ($this->user->save()) {
                // $this->user->notify(new PasswordChanged());
                auth()->logout();

                return redirect()->route('auth.login')->withErrors('Password has been successfully changed. You need to login again with new password');
            } else {
                return back()->withErrors('Something is wrong here');
            }
        }

        return back()->withErrors('Current password is incorrect');
    }

    /**
     * Page for updating user's profile.
     */
    public function profile()
    {
        $this->header();

        $this->breadcrumbs[] = ['name' => 'Profile', 'url' => route('user.settings.profile')];

        return $this->view('profile');
    }

    /**
     * Handle Profile Update Request.
     */
    public function profilePost(Request $request)
    {
        $request->validate([
            'name' => 'bail|required|max:255',
        ]);

        $this->user = auth()->user();

        $this->user->name = $request->name;

        if ($this->user->save()) {
            return back()->withSuccess('Your profile has been updated');
        }

        return back()->withErrors('Something is wrong here');
    }
}
