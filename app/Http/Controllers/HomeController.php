<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirectUser()
    {
        if (Auth::check()) {
            return redirect(url('dashboard'));
        } else {
            return redirect(route('login'));
        }
    }
}
