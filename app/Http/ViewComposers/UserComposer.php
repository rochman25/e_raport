<?php

namespace App\Http\ViewComposers;

use App\Models\RoleUser;
use Illuminate\View\View;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserComposer
{
    public function compose(View $view)
    {
        if(Auth::check()){
            $role = RoleUser::with('role')->where('user_id',Auth::user()->id)->first();
            // dd($role->role['name']);
            $view->with('baseRole',$role);
        }
    }
}