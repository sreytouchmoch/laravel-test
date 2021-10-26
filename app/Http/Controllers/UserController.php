<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'password' =>'required|confirmed',
        ]);
        // create Users
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();
        //create Token
        $token = $user->createToken('mytoken')->plainTextToken;

        return response()->json([
            'user'=>$user,
            'token'=>$token,
        ]);
    }
    public function logout (Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' =>'User logged out']);
    }
    public function login(Request $request)
    {

        // check email 
        $user = User::where ('email', $request->email)->first();
        // check password
        if (!$user || !Hash::check($request->password, $user->password)){
            return response()->json(['message' =>'Bad login'],401);
       } 

       $token = $user->createToken('mytoken')->plainTextToken;

        return response()->json([
            'user'=>$user,
            'token'=>$token,
        ]);
    }
}
 

