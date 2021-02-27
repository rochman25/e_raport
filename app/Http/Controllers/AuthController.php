<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPassword;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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

    public function forgetPassword(Request $request){
        return view('pages.forget_password');
    }

    public function forgetPasswordAction(Request $request){
        $request->validate([
            "email" => "required|email"
        ]);
        try{
            // dd($request);
            $user = User::where('email',$request->email)->first();
            if($user){
                // dd($user);
                $token = Crypt::encryptString($user->id);
                Mail::to($request->email)->locale('id')->send(
                    new ForgetPassword($token)
                );
                // return view('pages.forget_password_mail',compact('token'));
                return view('pages.success_send_forget_link');
            }else{
                return redirect()->back()->withErrors(['error'=>'Mohon maaaf email anda belum terdaftar di layanan kami.']);
            }
        }catch(Exception $e){
            dd($e);
        }
    }

    public function resetPassword(Request $request){
        return view('pages.reset_password');
    }

    public function resetPasswordAction(Request $request){
        $request->validate([
            "token" => "required",
            'password' => "required|confirmed",
        ]);
        // dd($request);
        try{
            DB::beginTransaction();
            $token = $request->token;
            $user = User::find(Crypt::decryptString($token));
            if($user){
                $user->password = $request->password;
                $user->save();
                // dd($user);
                DB::commit();
                return redirect()->route('auth.login')->with('success','Password anda sudah berhasil dirubah');
            }else{
                return redirect()->back()->withErrors(['error' => "Mohon maaf data yang anda kirimkan tidak valid"]);
            }
            // dd($request);
        }catch(Exception $e){
            // dd($e);
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => "Mohon maaf terjadi kesalahan. Kode Error : ".$e->getCode()]);
        }
    }


}
