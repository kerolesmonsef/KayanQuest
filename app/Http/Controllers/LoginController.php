<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function testlogAdmin()
    {
        $user = User::find(2);
        auth()->login($user);
        return redirect(url('/home'));
    }
}
