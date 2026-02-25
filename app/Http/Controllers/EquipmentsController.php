<?php

namespace App\Http\Controllers;

use App\Models\Equipments;
use Illuminate\Http\Request;

class EquipmentsController extends Controller
{
     public function createEquipments(Request $request){
        $validated = $request->validate([
            'name' =>'required|string',
            'usage' =>'required|string|max:800',
            'model_number' =>'required|string|unique:equipment,model_number',
            'value' =>'required|numeric',
            'status' =>'required|boolean',
             ]);

             $equipments = new Equipments();
             $equipments->name = $validated['name'];
             $equipments->usage = $validated['usage'];
             $equipments->model_number = $validated['model_number'];
             $equipments->value = $validated['value'];
             $equipments->status = $validated['status'];

             try{
                $equipments->save();
                return response()->json($equipments);
             }
             catch(\Exception $exception){
                return response()->json([
                'error' => 'Failed to Save Equipments',
                'message'=>$exception->getMessage()
                ], 500);

             }

 }
 public function readAllEquipmentss(){
    try{
        $equipmentss = Equipments::all();
        return response()->json($equipmentss);
     }
     catch(\Exception $exception){
        return response()->json([
            'error' => 'Failed to fetch Equipmentss.',
            'message' => $exception->getMessage()
        ], 500);
     }
 }
 public function readEquipments($id){
    try{
        $equipments = Equipments::findorFail($id);
        return response()->json($equipments);

    }
    catch(\Exception $exception){
        return response()->json([
            'error' => 'Failed to fetch Equipments.',
            'message' => $exception->getMessage()
        ]);
      }
   }
   public function updateEquipments(Request $request,$id){
     $validated = $request->validate([
            'name' =>'required|string',
            'usage' =>'required|string|max:800',
            'model_number' =>'required|string|unique:equipment,model_number',
            'value' =>'required|numeric',
            'status' =>'required|boolean',
             ]);
    try{
        $equipments = Equipments::findorFail($id);
        $equipments->name = $validated['name'];
        $equipments->usage = $validated['usage'];
        $equipments->model_number = $validated['model_number'];
        $equipments->value = $validated['value'];
        $equipments->status = $validated['status'];
        $equipments->save();
        return response()->json($equipments);
         }
         catch(\Exception $exception){
                return response()->json([
                'error' => 'Failed to Save Equipments',
                'message'=>$exception->getMessage()
                ], 500);
   }
}
public function deleteEquipments($id){
    try{
        $equipments = Equipments::findorFail($id);
        $equipments->delete();
        return response("Equipments deleted successfully!");
    }
    catch(\Exception $exception){
        return response()->json([
            'error' => 'Failed to delete Equipments.',
            'message' => $exception->getMessage()
        ], 500);
    }
}

}
