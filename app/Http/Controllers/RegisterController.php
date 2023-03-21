<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;
class RegisterController extends Controller
{
    public function create(){
       // echo 'HELLO';
        return view('register.create');
    }
//    public function store(Request $request) {
   // 差異？
//     }
    public  function store(){
  
    //    $validate = request()->validate([
    //         'name' => 'required|max:20|min:3',
    //         'username' => 'required|max:20|min:3',
    //         'email' => 'required|email',
    //         'password' => 'required|min:7'
    //     ]);

    $validate = request()->validate([
        'name' => 'required|max:20|min:3',
       // 'username' => 'required|max:20|min:3|unique:users,username',
       'username' => ['required', 'max:20' ,'min:3', Rule::unique('users', 'username')],
        'email' => 'required|email',
        'password' => 'required|min:7'
    ], [
        'required' => ':attribute 欄位是必填的。', //attribute這個是固定的,如果前端表格name,還沒研究怎麼換成自定義
        'email' => ':attribute 欄位必須是有效的電子郵件地址。', //
        'min' => ':attribute 欄位至少要 :min 個字元。',
        'max' => ':attribute 欄位最多只能有 :max 個字元。',
        'unique' =>'此 :attribute 重複註冊。',
    ]);

        
        // $validate['password'] = bcrypt($validate['password']);
      User::create($validate);

    return redirect('/');   
    //   User::create();
    }
}
