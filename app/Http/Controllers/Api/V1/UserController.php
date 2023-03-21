<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\V1\UserResource;
//use App\Http\Controllers\Api\V1\Validator;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{

    public function index()
    {
        //return user::all();
        $users = User::paginate(2);
        return UserResource::collection($users);
    }

        public function store(Request $request)
        {
        try {
            $hash = $request->validate([
                'name' => 'required|max:20',
                'email' => 'required',
                'password' => 'required|min:4|max:200',
            ]);
           $hash['password'] = bcrypt($hash['password']);
           
           $user = User::create($hash);

           $userResource = new UserResource($user);
            return response()->json([
                'message' => '註冊成功',
                'user' => $userResource,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => '註冊失敗',
            ], 400);
        }
       
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return new UserResource($user);
        //可以查找某筆資料例如
        //http://127.0.0.1:8000/api/v1/user/1
        //http://127.0.0.1:8000/api/v1/user/2
    }

    public function update(Request $request, string $id)
    {
   
        $user = User::findOrFail($id);
        //dd($request->all());
        $user->update($request->all());
        $UserResource = new UserResource($user);
        return response($UserResource);
    }

    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
    
            return response()->json([
                'message' => '刪除成功',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => '找不到資源',
            ], 404);
        }
    }
}
