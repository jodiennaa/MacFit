<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request){
        $validated = $request->validate([
            'name'=>'required|string|max:40',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:4|max:15|confirmed',
            'user_image'=>'nullable|image|mimes:jpeg,png,jpg',

        ]);

         if($request->role_id){
            $role_id = $request->role_id;
            
        } else{
            $role_id = Role::where('name', 'user')->first();
           
        }

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role_id = $role_id;
        $user->password = Hash::make($validated['password']);

        if($request->hasFile('user_image')){
            $filename = $request->file('user_image')->store('users', 'public');
            
        } else{
            $filename = null;
        }
        $user->user_image = $filename;



        try{
            $user->save();

             $signedURL = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->id,
             'hash' => sha1($user->email)
             ]
        );
        $user->notify(new VerifyEmailNotification($signedURL));

        return response()->json([
            'message'=>'Verification Email sent successfully.',
            'user'=>$user,
        ],200);

        }
        catch(\Exception $exception){
            return response()->json([
                'error' => 'Registration Failed!',
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function login (Request $request){
        $validated = $request->validate([
            'email'=>'required|email',
            'password'=>'required|string|min:4',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if(!$user || !Hash::check($validated['password'], $user->password))
            throw ValidationException::withMessages([
                'Error'=>'Invalid Credentials'],401);

                if(!$user->is_active){
                    return response()->json([
                        'message'=>'Your Account is not active. Please verify your email address.',
                    ],403);
                }

                 $token = $user->createToken("auth-token")->plainTextToken;
            return response()->json([
                'message'=>'Login Successful!',
                'token'=>$token,
                'user'=>$user,
                'abilities'=>$user->abilities(),


            ]);
            
            }

            public function logout(Request $request){
                $request->user()->currentAccessToken()->delete();
                return response()->json([
                    'message'=>'Logout Successful!'
                ]);

            }

            
        }


    

