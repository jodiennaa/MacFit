<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class ResendEmailVerificationController extends Controller
{
    public function resend(Request $request){
        $request->validate([
            'email'=>'required|email'
        ]);

        $user = User::where('email',$request->email)->first();

        if(!$user){
            return response()->json([
                'message' => 'User not found.',
            ], 404);
        }

        if($user->hasVerifiedEmail()){
            return response()->json([
                'message' => 'Email is already verified.',
            ], 200);
        }

        $signedURL = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->id,
             'hash' => sha1($user->email)
             ]
        );
        $user->motify(new VerifyEmailController($signedURL));

        return response()->json([
            'message'=>'Verification Email resent successfully.'
        ],200);
         
    }
}
