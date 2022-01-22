<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    public $successStatus = 200;
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('POS')->accessToken;
        $success['name'] =  $user->name;

        $member = new Member();
        $member->user_id = $user->id;
        $member->role_id = 4;
        $member->gym_id = $request->gym;
        $member->save();
        return response()->json(['success'=>$success], $this->successStatus);
    }

    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $member_role = Member::where('user_id', $user->id)->value('role_id');
            if ($member_role != 4){
                return response()->json(['error'=>'Unauthorised'], 401);
            }
            else{
                $success['token'] =  $user->createToken('POS')-> accessToken;
                return response()->json(['user' => $user ,'success' => $success], $this-> successStatus);
            }
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
}
