<?php

namespace App\Http\Controllers;

use App\Events\UserRegisteredEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login() {
        return view('login');
    }

    public function authenticate(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()) {

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('account.dashboard');
            } else {
                return redirect()->route('account.login')
                    ->withInput()
                    ->with('error','Email or password is incorrect.');
            }
        } else {
             return redirect()->route('account.login')
                ->withInput()
                ->withErrors($validator);
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('account.login');
    }

    public function register() {
        return view('register');
    }

    public function processRegister(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        if ($validator->passes()) {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->role = 'guest';
            $user->save();

            UserRegisteredEvent::dispatch($user);
            
            return redirect()->route('account.login')->with('success', 'You have registered successfully!');

        } else {
             return redirect()->route('account.register')
                ->withInput()
                ->withErrors($validator);
        }
    }
}
