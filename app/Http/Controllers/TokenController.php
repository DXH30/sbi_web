<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class TokenController extends Controller
{
    public function verify($a = NULL, Request $request)
    {
        if ($a == 'u') {
            $id = auth()->user()->id;
            $token = $request->input('token');
            $token_v = User::get()->where('id', $id)->first()['token'];
            if ($token == $token_v) {
                User::where('id', $id)->update(['verified' => 1]);
                return redirect()->route('dashboard');
            } else {
                return redirect()->back()->withErrors('Token salah!');
            }
        } else {
            return view('verifytoken');
        }
    }
}
