<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BundlesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EquipmentsController;
use App\Http\Controllers\GymController;
use App\Http\Controllers\ResendEmailVerificationController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VerifyEmailController;

    //Public Routes
Route::post('register',[AuthController::class, 'register']);
Route::post('login',[AuthController::class, 'login']);

//Email Verification
Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])
->name('verification.verify')
->middleware(['signed', 'throttle:6,1']);

Route::post('/email/resend', [ResendEmailVerificationController::class, 'resend'])
->middleware('throttle:6,1');


    //Protected Routes
Route::middleware('auth:sanctum')->group(function () {

Route::post('logout',[AuthController::class, 'logout']);


    


Route::post('/saveRole',[RoleController::class, 'createRole']);
Route::get('/getRoles',[RoleController::class, 'readAllRoles']);
Route::get('/getRole/{id}',[RoleController::class, 'readRole']);
Route::post('/updateRole/{id}',[RoleController::class, 'updateRole']);
Route::post('/deleteRole/{id}',[RoleController::class, 'deleteRole']);

Route::post('/saveCategory',[CategoryController::class, 'createCategory']);
Route::get('/getCategory',[CategoryController::class, 'readAllCategories']);
Route::get('/getCategory/{id}',[CategoryController::class, 'readCategory']);
Route::post('/updateCategory/{id}',[CategoryController::class, 'updateCategory']);
Route::post('/deleteCategory/{id}',[CategoryController::class, 'deleteCategory']);

Route::post('/saveGym',[GymController::class, 'createGym']);
Route::get('/getGyms',[GymController::class, 'readAllGyms']);
Route::get('/getGym/{id}',[GymController::class, 'readGym']);
Route::post('/updateGym/{id}',[GymController::class, 'updateGym']);
Route::post('/deleteGym/{id}',[GymController::class, 'deleteGym']);

Route::post('/saveBundle',[BundlesController::class, 'createBundles']);
Route::get('/getBundles',[BundlesController::class, 'readAllBundles']);
Route::get('/getBundle/{id}',[BundlesController::class, 'readBundle']);
Route::post('/updateBundle/{id}',[BundlesController::class, 'updateBundle']);
Route::post('/deleteBundle/{id}',[BundlesController::class, 'deleteBundle']);

Route::post('/saveUsers',[UsersController::class, 'createUsers']);
Route::get('/getUsers',[UsersController::class, 'readAllUsers']);
Route::get('/getUser/{id}',[UsersController::class, 'readUsers']);
Route::post('/updateUser/{id}',[UsersController::class, 'updateUsers']);
Route::post('/deleteUser/{id}',[UsersController::class, 'deleteUsers']);

Route::post('/saveSubscription',[SubscriptionController::class, 'createSubscription']);
Route::get('/getSubscriptions',[SubscriptionController::class, 'readAllSubscriptions']);
Route::get('/getSubscription/{id}',[SubscriptionController::class, 'readSubscription']);
Route::post('/updateSubscription/{id}',[SubscriptionController::class, 'updateSubscription']);
Route::post('/deleteSubscription/{id}',[SubscriptionController::class, 'deleteSubscription']);

Route::post('/saveEquipment',[EquipmentsController::class, 'createEquipments']);
Route::get('/getEquipments',[EquipmentsController::class, 'readAllEquipments']);
Route::get('/getEquipment/{id}',[EquipmentsController::class, 'readEquipments']);
Route::post('/updateEquipment/{id}',[EquipmentsController::class, 'updateEquipments']);
Route::post('/deleteEquipment/{id}',[EquipmentsController::class, 'deleteEquipments']);


});
