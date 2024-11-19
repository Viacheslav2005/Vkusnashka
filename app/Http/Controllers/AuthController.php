<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function show_reg() {
        return view('signup');
    }

    public function show_signin() {
        return view('signin');
    }

    public function signup(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255|regex:/^[A-Za-zА-Я0-9]+$/',
            'surname' => 'required|regex:/^[A-Za-z0-9]+$/',
            'patronymic' => 'required|regex:/^[A-Za-z0-9]+$/',
            'login' => 'required|string|max:255|regex:/^[A-Za-z0-9]+$/',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_repeat' => 'required',
        ]);

        if ($request->password == $request->password_repeat) {
            $user = User::create([
                "name" => $request->name,
                "surname" => $request->surname,
                "patronymic" => $request->patronymic,
                "login" => $request->login,
                "email" => $request->email,
                "password" => Hash::make($request->password),
            ]);

            Auth::login($user);
            return redirect()->route('personal_account')
                ->with('message', 'Регистрация прошла успешно!')
                ->with('alert_type', 'success');
        } else {
            return back()->withErrors(['password_repeat' => 'Пароли не совпадают.']);
        }
    }

    public function signin(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin');
            } elseif ($user->role === 'user') {
                return redirect()->route('personal_account');
            }
        } else {
            return back()
                ->with('message', 'Неверные данные для входа!')
                ->with('alert_type', 'danger');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('index')
            ->with('message', 'Вы вышли из системы')
            ->with('alert_type', 'success');
    }
}
