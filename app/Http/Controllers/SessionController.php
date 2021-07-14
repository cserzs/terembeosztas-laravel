<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function login() {
        return view('session.login');
    }

    public function processLogin() {
        $attributes = request()->validate(User::getValidationRules());

        if (!auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                'username' => 'Érvénytelen felhasználónév vagy jelszó!'
            ]);
        }

        session()->regenerate();

        return redirect('/catalog/index');        
    }

    public function logout() {
        auth()->logout();

        return redirect('/');
    }
}
