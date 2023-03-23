<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function destory(){
        auth()->logout();

        return redirect('/')->with('success', '您已經登出～');
        
    }
}
