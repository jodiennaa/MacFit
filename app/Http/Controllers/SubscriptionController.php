<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
     public function createSubscription(Request $request){
        $validated = $request->validate([
            'user_id' =>'integer|required|exists:users,id',
            'bundle_id' =>'integer|required|exists:bundles,id',
             ]);

             $subscription = new Subscription();
             $subscription->user_id = $validated['user_id'];
             $subscription->bundle_id = $validated['bundle_id'];

             try{
                $subscription->save();
                return response()->json($subscription);
             }
             catch(\Exception $exception){
                return response()->json([
                'error' => 'Failed to Save Subscription',
                'message'=>$exception->getMessage()
                ], 500);

             }

 }
 public function readAllSubscriptions(){
    try{
        $subscriptions = Subscription::all();
        return response()->json($subscriptions);
     }
     catch(\Exception $exception){
        return response()->json([
            'error' => 'Failed to fetch Subscriptions.',
            'message' => $exception->getMessage()
        ], 500);
     }
 }
 public function readSubscription($id){
    try{
        $subscription = Subscription::findorFail($id);
        return response()->json($subscription);

    }
    catch(\Exception $exception){
        return response()->json([
            'error' => 'Failed to fetch Subscription.',
            'message' => $exception->getMessage()
        ]);
      }
   }
   public function updateSubscription(Request $request,$id){
     $validated = $request->validate([
           'user_id' =>'integer|required|exists:users,id',
            'bundle_id' =>'integer|required|exists:bundles,id',
             ]);
    try{
        $subscription = Subscription::findorFail($id);
        $subscription->user_id = $validated['user_id'];
        $subscription->bundle_id = $validated['bundle_id'];
        $subscription->save();
        return response()->json($subscription);
         }
         catch(\Exception $exception){
                return response()->json([
                'error' => 'Failed to Save Subscription',
                'message'=>$exception->getMessage()
                ], 500);
   }
}
public function deleteSubscription($id){
    try{
        $subscription = Subscription::findorFail($id);
        $subscription->delete();
        return response("Subscription deleted successfully!");
    }
    catch(\Exception $exception){
        return response()->json([
            'error' => 'Failed to delete Subscription.',
            'message' => $exception->getMessage()
        ], 500);
    }
}
}
