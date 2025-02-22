<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\EnsureAdminAuthorization;
use App\Http\Middleware\EnsureAdminCannotUpload;
use App\Http\Middleware\isAuthenticated;
use App\Livewire\Admin\Auth;
use App\Livewire\Gallery\Gallery;
use Illuminate\Support\Facades\Route;

use Laravel\Socialite\Facades\Socialite;

use App\Livewire\Home;
use App\Livewire\Profile;
use App\Livewire\Settings;

use App\Livewire\Uploader\Publish;
use App\Livewire\Uploader\Reject;
use App\Livewire\Uploader\Review;
use App\Livewire\Uploader\Upload;

use App\Livewire\Admin\Approved;
use App\Livewire\Admin\Pending;
use App\Livewire\Admin\Rejected;

Route::get('/', Home::class);

Route::get('/gallery', Gallery::class);

// Third party authentication with google
Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/auth/google/callback', [AuthController::class, 'index']);

Route::prefix('profile')->group(function () {
        
    Route::get('/{UUID}', Profile::class);

    Route::middleware(isAuthenticated::class)->group(function() {  
        Route::get('/{UUID}/settings', Settings::class);
        // Route::post('/settings', [Settings::class, 'upload']);
    });
    // Route::post('/banner', [Profile::class, 'upload']);
});

Route::middleware(isAuthenticated::class)->group(function() {

    Route::post('/logout', [AuthController::class,'logout']);
    
    // uploading routes
    Route::prefix('upload')->middleware(EnsureAdminCannotUpload::class)->group(function () {
        Route::get("/", Upload::class);
        Route::get("/review", Review::class);
        Route::get("/publish", Publish::class);
        Route::get("/reject", Reject::class);
    });
});

// Admin section 

Route::prefix("su-admin")->middleware(EnsureAdminAuthorization::class)->group(function() {
    Route::get('/', Pending::class);
    Route::get('rejected', Rejected::class);
    Route::get('approved', Approved::class);

});

// Redirect to previous page if url not found
Route::fallback(function () {
    return redirect()->back();
});