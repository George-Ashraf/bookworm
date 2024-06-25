<?php
namespace App\Http\Traits;

use App\Providers\RouteServiceProvider;

trait AuthTrait
{
    public function chekGuard($request){

        if($request->type == 'admin'){
            $guardName= 'admin';
        }
        elseif ($request->type == 'author'){
            $guardName= 'author';
        }
        elseif ($request->type == 'bookstore'){
            $guardName= 'bookstore';
        }
        else{
            $guardName= 'web';
        }
        return $guardName;
    }

    public function redirect($request){

        if($request->type == 'admin'){
            return redirect()->intended(RouteServiceProvider::ADMIN);
        }
        elseif ($request->type == 'author'){
            return redirect()->intended(RouteServiceProvider::AUTHOR);
        }
        elseif ($request->type == 'bookstore'){
            return redirect()->intended(RouteServiceProvider::BOOKSTORE);
        }
        else{
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }
}
