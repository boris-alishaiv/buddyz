<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class UserController extends Controller
{
    public function signup(Request $request)
    {
        $this->validate($request, [
            'type' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:255',
            'dateOfBirth' => 'required|',
            'gender' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'type' => $request['type'],
            'first_name' => $request['firstName'],
            'last_name' => $request['lastName'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'date_of_birth' => $request['dateOfBirth'],
            'gender' => $request['gender'],
            'address' => $request['address'],
            'city' => $request['city'],
            'score' => isset($request['score']) ? $request['score'] : null,
            'privacy' => isset($request['privacy']) ? $request['privacy'] : null,
            'level' => isset($request['level']) ? $request['level'] : null,
            'password' => bcrypt($request['password']),
        ]);
        $user->save();

        $credentials = $request->only('email', 'password');
        $token = JWTAuth::attempt($credentials);

        return response()->json([
            'message' => 'successful operation',
            'token' => $token
        ], 200);
    }


    public function signin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)){
                return response()->json([
                    'error' => 'invalid credentials'
                ],401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Could not create token'
            ], 500);

        }

//        $user = JWTAuth::parseToken()->toUser();
        return response()->json([
            'tokrn' => $token
        ], 200);
    }



    public function redirectToProvider($accountType)
    {
        return Socialite::driver($accountType)->redirect();
    }

    public function handleCallback($driver)
    {
        // user fetched from facebook/google
        $user = Socialite::driver($driver)->user();

        $dbUser = User::where('account_type', $driver)
            ->where("sns_acc_id", $user->id)
            ->first();

        if ($dbUser){
            return response()->json([
                'user' => $dbUser,
                'token' => JWTAuth::fromUser($dbUser)
            ], 200);
        }

        $dbUser = User::create([
            'type' => "",
            'first_name' => $user->name,
            'last_name' => "",
            'email' => $user->email,
            'phone' => "",
            'date_of_birth' => null,
            'gender' => isset($user->user['gender']) ? $user->user['gender'] : "",
            'address' => "",
            'city' => "",
            'score' => null,
            'privacy' => null,
            'level' => null,
            'password' => "",
            'account_type' => $driver,
            'sns_acc_id' => $user->id
        ]);
        $dbUser->save();

        return response()->json([
            'user' => $dbUser,
            'token' => JWTAuth::fromUser($dbUser)
        ], 200);
    }


}
