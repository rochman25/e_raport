<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function viewLogin(){
        return view('pages.login');
    }

    public function authenticate(Request $request){
        $validator = Validator::make(request()->all(), [
            'username' => 'required',
            'password' => 'required|min:4'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = [
            'username'  => $request->input('username'),
            'password'  => $request->input('password'),
        ];
        // dd($data);
        Auth::attempt($data);
        // dd(Auth::check());
        if (Auth::check()) {
            return redirect()->route('view.home');
        } else {
            return redirect()->back()->withErrors(['loginError'=>'Username atau password salah']);
        }
    }

    public function changeRole(Request $request){
        $role = $request->role_name;
        try {
            $request->session()->put('role',$role);
            $success = true;         
            return response()->json(['success'=>$success,'role'=>$request->session('role')]);
        } catch (\Exception $e) {
            return response()->json(['success' => false,'errors' => $e]);
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->forget('role');
        return redirect()->route('auth.login');
    }

}
