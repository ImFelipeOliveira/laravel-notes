<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        $this->validateLoginData($request);
        $credentials = $this->getLoginCredentials($request);
        $user = $this->getUserByUsername($credentials['username']);

        if ($user && password_verify($credentials['password'], $user->password)) {
            $this->createSession($request, $user);
            $this->updateLastLogin($user);
            return redirect('/');
        }
        return redirect()->back()->withInput()->withErrors(['loginError' => 'Invalid credentials']);
    }

    protected function validateLoginData(Request $request)
    {
        $request->validate([
            'text_username' => 'required|email',
            'text_password' => 'required|min:6|max:16',
        ], [
            "text_username.required" => "Username is required.",
            "text_username.email" => "Username must be a valid email address.",
            "text_password.required" => "Password is required.",
            "text_password.min" => "Password must be at least 6 characters.",
            "text_password.max" => "Password must not exceed 16 characters.",
        ]);
    }

    protected function getLoginCredentials(Request $request)
    {
        return [
            'username' => $request->input('text_username'),
            'password' => $request->input('text_password'),
        ];
    }

    protected function getUserByUsername(string $username)
    {
        return User::where('username', $username)->first();
    }

    protected function createSession(Request $request, User $user)
    {
        $request->session()->put('user', [
            "id" => $user->id,
            "username" => $user->username,
        ]);
    }

    protected function updateLastLogin(User $user)
    {
        $user->last_login = now();
        $user->save();
    }
}
