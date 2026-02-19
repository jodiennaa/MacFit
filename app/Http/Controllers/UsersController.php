<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
     public function createUsers(Request $request){
        $validated = $request->validate([
            'name' =>'required|string',
            'email' =>'required|string',
            'password' =>'required|string',
            'role_id' =>'required|integer|exists:roles,id',
             ]);

             $users = new Users();
             $users->name = $validated['name'];
             $users->email = $validated['email'];
             $users->password = bcrypt($validated['password']);
             $users->role_id = $validated['role_id'];
             
             try{
                $users->save();
                return response()->json($users);
             }
             catch(\Exception $exception){
                return response()->json([
                'error' => 'Failed to Save Users',
                'message'=>$exception->getMessage()
                ], 500);

             }

 }
 public function readAllUsers(){
    try{
        $userss = Users::all();
        return response()->json($userss);
     }
     catch(\Exception $exception){
        return response()->json([
            'error' => 'Failed to fetch Users.',
            'message' => $exception->getMessage()
        ], 500);
     }
 }
 public function readUsers($id){
    try{
        $users = Users::findorFail($id);
        return response()->json($users);

    }
    catch(\Exception $exception){
        return response()->json([
            'error' => 'Failed to fetch Users.',
            'message' => $exception->getMessage()
        ]);
      }
   }
   public function updateUsers(Request $request,$id){
     $validated = $request->validate([
            'name' =>'required|string',
            'email' =>'required|string',
            'password' =>'required|string',
            'role_id' =>'required|integer|exists:roles,id',
             ]);

    try{
        $users = Users::findorFail($id);
        $users->name = $validated['name'];
             $users->email = $validated['email'];
             $users->password = bcrypt($validated['password']);
             $users->role_id = $validated['role_id'];
             $users->save();
        return response()->json($users);
         }
         catch(\Exception $exception){
                return response()->json([
                'error' => 'Failed to Save Users',
                'message'=>$exception->getMessage()
                ], 500);
   }
}
public function deleteUsers($id){
    try{
        $users = Users::findorFail($id);
        $users->delete();
        return response("Users deleted successfully!");
    }
    catch(\Exception $exception){
        return response()->json([
            'error' => 'Failed to delete Users.',
            'message' => $exception->getMessage()
        ], 500);
    }
}
}
