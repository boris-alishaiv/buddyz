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



    public function updateUser(Request $request)
    {
        // TODO: get current user using auth
        $user = User::find(1);

        if (isset($request['type']))  $user->type = $request['type'];
        if (isset($request['firstName']))  $user->first_name = $request['firstName'];
        if (isset($request['lastName']))  $user->last_name = $request['lastName'];
        if (isset($request['email']))  $user->email = $request['email'];
        if (isset($request['phone']))  $user->phone = $request['phone'];
        if (isset($request['dateOfBirth']))  $user->date_of_birth = $request['dateOfBirth'];
        if (isset($request['gender']))  $user->gender = $request['gender'];
        if (isset($request['address']))  $user->address = $request['address'];
        if (isset($request['city']))  $user->city = $request['city'];
        if (isset($request['score']))  $user->score = $request['score'];
        if (isset($request['privacy']))  $user->privacy = $request['privacy'];
        if (isset($request['level']))  $user->level = $request['level'];
        $user->save();

        return response()->json('successful operation',202);
    }


    public function uploadAvatar(Request $request)
    {
        
    }

}
