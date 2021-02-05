<?php

namespace App\Http\ViewComposers;

use App\Models\RoleUser;
use Illuminate\View\View;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserComposer
{
    public function compose(View $view)
    {
        if(Auth::check()){
            $role = RoleUser::with('role','user','user.guru','user.guru.walikelas')->where('user_id',Auth::user()->id)->first();
            if(session('role')){
                $s_role = session('role');
            }else{
                $s_role = session('role', $role->role->name);
            }
            // dd($role->toArray());
            // dd($s_role);
            $view->with(['baseRole'=>$role,'s_role'=>$s_role]);
        }
    }
}