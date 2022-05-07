<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\CampaignDataController;
use App\Http\Controllers\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::resource('products', ProductController::class);

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/email', [TemplateController::class, 'index']);
Route::post('/forgot', [ForgotPasswordController::class, 'forgot']);
Route::post('/reset', [ForgotPasswordController::class, 'reset']);
Route::get('/template/{id}', [TemplateController::class, 'show']);
Route::get('/favoriteTemplate/{id}', [TemplateController::class, 'showFavorite']);
Route::get('/templateEmail/{id}', [TemplateController::class, 'showTemplate']);
Route::get('/templateImage/{id}', [UploadController::class, 'showImage']);
Route::post('/image-upload', [UploadController::class, 'upload']);
Route::get('/getImage/{filename}', [UploadController::class, 'displayImage']);
Route::get('/showImage/{id}', [UploadController::class, 'showAllImage']);
Route::put('/updateFavorite/{id}',[TemplateController::class, 'updateFavorites']);
Route::put('/removeFavorite/{id}',[TemplateController::class, 'removeFavorites']);
Route::post('/sendMail',[MailController::class, 'sendMail']);
Route::post('/createCampaignData',[CampaignDataController::class, 'storeCampaignData']);
Route::get('/showCampaignData',[CampaignDataController::class, 'getCampaignData']);
Route::get('/showCampaignData/{id}',[CampaignDataController::class, 'showCampaignData']);
Route::get('/showAll/{id}', [TemplateController::class, 'showAll']);
// Route::get('/getTemplate/{id}', [TemplateController::class, 'getTemplate']);
// Route::get('/products/search/{name}', [ProductController::class, 'search']);


// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/createEmail', [TemplateController::class, 'store']);
    Route::put('/templateUpdate/{id}', [TemplateController::class, 'update']);
    Route::delete('/templateDel/{id}', [TemplateController::class, 'destroy']);
    Route::post('/userUpdate/{id}', [AuthController::class, 'updateUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
});



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
