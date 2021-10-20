<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->setView('auth');
        $this->setRoute('auth');
    }

    public function login()
    {
        $this->header();

        return $this->view('login');
    }

    public function register()
    {
        $this->header();

        return $this->view('register');
    }

    public function lostPassword()
    {
        $this->header();

        return $this->view('lostpass');
    }

    /**
     * Handle Login form submisison.
     *
     * @param  LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginPost(LoginRequest $request)
    {
        /*$request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);*/

        if (! auth()->attempt($request->only(['email', 'password']), $request->remember)) {
            return back()->withErrors('Email or Password is incorrect');
        }

        $user = auth()->user();

        if (! empty($request->redir)) {
            $url = rawurldecode($request->redir);
        } else {
            $url = route('user.index');
        }

        return redirect($url)->withSuccess('You have been logged in successfully.');
    }

    public function registerPost(RegistrationRequest $request)
    {
        $user = new User();
        $user->fill($request->validated());
        $user->password = bcrypt($request->password);
        $user->role = 'user';

        if (! $user->save()) {
            return back()->withErrors('Something is wrong. Please try again.');
        }

        auth()->login($user, true);

        if (! empty($request->redir)) {
            $url = rawurldecode($request->redir);
        } else {
            $url = route('user.index');
        }

        return redirect($url)->withSuccess('You have been registered successfully...');
    }

    public function resetPasswordPost(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('mobile', $request->mobile)->first();
        $user->password = bcrypt($request->password);

        if ($user->save()) {
            return redirect()->route('auth.login')->withSuccess('Password has been updated successfully');
        } else {
            return back()->withErrors('Something is wrong here...');
        }
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/auth/login')->withSuccess('You have been logged out successfully.');
    }
}
