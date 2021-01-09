<?php

namespace App\Providers;

use App\Models\RoleUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // if(Auth::check()){
        //     $role = RoleUser::where('user_id',Auth::user()->id)->first();
        //     dd($role);
        // }
        // dd(Auth::check());
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // if(Auth::check()){
        //     $role = RoleUser::where('user_id',Auth::user()->id)->first();
        //     dd($role);
        // }
        // dd(Session::get());
    }
}
