<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Group;

class RegistrationController extends Controller
{
    public function create(Request $request)
    {
        $obj = [
            'group_id' => $request->input('grup'),
            'group_list' => Group::get()
        ];
        return view('register', $obj);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'group_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $request['password'] = Hash::make($request['password']);
        $email_exists = User::where('email', '=', $request['email'])->count();
        $user_exists = User::where('name', '=', $request['name'])->count();

        if (User::where('email', '=', $request['email'])->exists()) {
            return redirect()->to('/login')->withErrors(["Email sudah terdaftar silahkan login"]);
        }
        if (User::where('name', '=', $request['name'])->exists()) {
            return redirect()->to('/login')->withErrors(["Username sudah terdaftar silahkan login"]);
        }
        $user = User::create($request->all());
        auth()->login($user);
        return redirect()->to('/');
    }
}
