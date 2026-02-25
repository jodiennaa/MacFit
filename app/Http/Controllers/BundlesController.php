<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bundles;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class BundlesController extends Controller
{
    public function createBundles(Request $request){
        $validated = $request->validate([
            'name' =>'required|string|unique:bundles,name',
            'start_time' =>'required',
            'duration' =>'required',
            'description' =>'required|string|max:1000',
            'category_id' =>'integer|required|exists:categories,id',
            
             ]);

             $bundle = new Bundles();
             $bundle->name = $validated['name'];
             $bundle->start_time = $validated['start_time'];
             $bundle->duration = $validated['duration'];
             $bundle->description = $validated['description'];
             $bundle->category_id = $validated['category_id'];

             try{
                $bundle->save();
                return response()->json($bundle);
             }
             catch(\Exception $exception){
                return response()->json([
                'error' => 'Failed to Save Bundles',
                'message'=>$exception->getMessage()
                ], 500);

             }

 }
 public function readAllBundles(){
    try{
        $bundles = Bundles::all();
        $bundles = Bundles::join('categories', 'bundles.category_id', '=', 'categories.id')
            ->select('bundles.*', 'categories.name as category_name')
            ->get();


        return response()->json($bundles);
     }
     catch(\Exception $exception){
        return response()->json([
            'error' => 'Failed to fetch Bundles.',
            'message' => $exception->getMessage()
        ], 500);
     }
 }
 public function readBundle($id){
    try{
        $bundle = Bundles::findorFail($id);
         $bundles = Bundles::join('categories', 'bundles.category_id', '=', 'categories.id')
        ->select('bundles.*', 'categories.name as category_name')
        ->where('bundles.id', $id)
        ->first();
        return response()->json($bundle);

    }
    catch(\Exception $exception){
        return response()->json([
            'error' => 'Failed to fetch Bundles.',
            'message' => $exception->getMessage()
        ]);
      }
   }
   public function updateBundles(Request $request,$id){
     $validated = $request->validate([
            'name' =>'required|string',
            'start_time' =>'required',
            'duration' =>'required',
            'description' =>'string|max:1000',
            'category_id' =>'integer|required|exists:categories,id',
     ]);
    try{
             $bundle = Bundles::findorFail($id);
             $bundle->name = $validated['name'];
             $bundle->start_time = $validated['start_time'];
             $bundle->duration = $validated['duration'];
             $bundle->description = $validated['description'];
             $bundle->category_id = $validated['category_id'];
$bundle->save();
        return response()->json($bundle);
         }
         catch(\Exception $exception){
                return response()->json([
                'error' => 'Failed to Save Bundles',
                'message'=>$exception->getMessage()
                ], 500);
   }
}
public function deleteBundles($id){
    try{
        $bundle = Bundles::findorFail($id);
        $bundle->delete();
        return response("Bundles deleted successfully!");
    }
    catch(\Exception $exception){
        return response()->json([
            'error' => 'Failed to delete Bundles.',
            'message' => $exception->getMessage()
        ], 500);
    }
}
}
