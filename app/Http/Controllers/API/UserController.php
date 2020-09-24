<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var($request->name, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        if (auth()->attempt(array($fieldType => $input['name'], 'password' => $input['password']))) {
            return response()->json(['msg'=>'login sukses', 'login'=>'1']);
        } else {
            return response()->json(['msg'=>'login gagal', 'login'=>'-1']);
        }
    }

    public function register(Request $request)
    {
        $input = $request->all();
        $obj = [];
        var_dump($input);exit;
        if (User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($data['password']),
            'group_id' => $data['group_id'],
            'token' => rand(10000,99999)
        ])) {
            $obj['msg'] = 'berhasil buat akun';
            return response()->json($obj);
        } else {
            $obj['msg'] = 'gagal buat akun';
            return response()->json($obj);
        }
    }
}
