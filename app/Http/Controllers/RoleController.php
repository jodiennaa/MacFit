<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function createRole(Request $request){
        $validated = $request->validate([
            'name' =>'required|string|unique:roles,name',
            'description' =>'nullable|string|max:1000',
             ]);

             $role = new Role();
             $role->name = $validated['name'];
             $role->description = $validated['description'];

             try{
                $role->save();
                return response()->json($role);
             }
             catch(\Exception $exception){
                return response()->json([
                'error' => 'Failed to Save Role',
                'message'=>$exception->getMessage()
                ], 500);

             }

 }
 public function readAllRoles(){
    try{
        $roles = Role::all();
        return response()->json($roles);
     }
     catch(\Exception $exception){
        return response()->json([
            'error' => 'Failed to fetch Roles.',
            'message' => $exception->getMessage()
        ], 500);
     }
 }
 public function readRole($id){
    try{
        $role = Role::findorFail($id);
        return response()->json($role);

    }
    catch(\Exception $exception){
        return response()->json([
            'error' => 'Failed to fetch Role.',
            'message' => $exception->getMessage()
        ]);
      }
   }
   public function updateRole(Request $request,$id){
     $validated = $request->validate([
            'name' =>'required|string|unique:roles,name',
            'description' =>'nullable|string|max:1000',
             ]);
    try{
        $existingrole = Role::findorFail($id);
        $existingrole->name = $validated['name'];
        $existingrole->description = $validated['description'];
        $existingrole->save();
        return response()->json($existingrole);
         }
         catch(\Exception $exception){
                return response()->json([
                'error' => 'Failed to Save Role',
                'message'=>$exception->getMessage()
                ], 500);
   }
}
public function deleteRole($id){
    try{
        $role = Role::findorFail($id);
        $role->delete();
        return response("Role deleted successfully!");
    }
    catch(\Exception $exception){
        return response()->json([
            'error' => 'Failed to delete Role.',
            'message' => $exception->getMessage()
        ], 500);
    }
}
}
