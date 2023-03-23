<?php

namespace App\Http\Controllers;

//use Dotenv\Exception\ValidationException;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create()
    {

        return view('login.create');
    }

    public function store(Request $request)
    {
        //exists:users,email
        $validate = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        //兩種寫法一樣=====================     
        // if(auth()->attempt($validate)){
        //     session()->regenerate();
        //     return redirect('/')->with('success','歡迎你再次回來');
        // }
        //注意namespace
        if (Auth::attempt(['email' => $validate['email'], 'password' => $validate['password']])) {
            session()->regenerate();
            return redirect('/')->with('success', '歡迎你再次回來');
        }
        //====================

        //以下兩種寫法一樣效果=========
        // return back()->withInput()->withErrors(['email' => '輸入錯誤請重新輸入']);
        throw
        ValidationException::withMessages(['email' => '我也不知道這個會出現什麼']);
    }
    //=================

    public function destory()
    {
        auth()->logout();

        return redirect('/')->with('success', '您已經登出～');
    }
}
