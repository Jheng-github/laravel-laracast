<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
  

        //__('字串') //翻譯 多國語系 在lang/en/auth 
        //abort_if()
        //Auth::attempt
            // $this ->validate()推薦寫法 這樣才找得到引用哪個function
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
    $user =  User::create($validate);
   // Auth::user($user);
    auth()->login($user);
     //Auth::attempt(驗證的變數,回傳代號 400...等,'回傳字串') 會比較好追 因為不是help function 
    //如果都通過上面的驗證,就代表這個登入是正確的
    //應該是有透過一些session or cookie 來存放使用者資訊
    
   return redirect('/')->with('success', '你的帳號已經成功創建');


    //   session()->flash('success', '你的帳號已經成功創建');//同上一個
    //   return redirect('index');
  //  return view('index', ['username' => auth()->user()->username]);
    }
}
