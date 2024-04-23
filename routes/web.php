<?php

use App\Http\Controllers\ContributionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', function () {
//     return view('home');
// });



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/home', [HomeController::class, 'index'])->name('home');

// dang lam multiple cho student
// Route::group(['middleware' => ['auth', 'permission']],function(){
//     Route::get('/home', [HomeController::class, 'index'])->name('home');
//     //Route Faculty
//     Route::resource('facultys', FacultyController::class);

//     //Route Role
//     Route::resource('roles', RoleController::class);

//     //Route User
//     Route::resource('users', UserController::class);

//     //Route Event
//     Route::resource('events', EventController::class);

//     //Route Contribution
//     Route::resource('contributions', ContributionController::class);

//     // get download contribution
//     Route::get('contributions/download/{id}', [ContributionController::class, 'download'])->name('contributions.download');
//     //route permissions
//     Route::resource('permissions', PermissionController::class);
//     //route comment of contribution
//     Route::get('contributions/{contribution}/comment', [ContributionController::class, 'comment'])->name('contributions.comment');
//     Route::post('contributions/{contribution}/submit-comment', [ContributionController::class, 'submitComment'])->name('contributions.submitComment');
//     Route::get('contributions/view_comment/{id}', [ContributionController::class, 'viewComment'])->name('contributions.viewComments');

//     //test mail
//     Route::get('/contact',[ContributionController::class, 'contact'])->name('contribitions.contact');
// });

// dang lam multiple cho admin
// Route::group(['middleware' => ['auth', 'permission']],function(){
//     Route::get('/', function () {return view('welcome');});
//     //Route Faculty
//     Route::resource('facultys', FacultyController::class);

//     //Route Role
//     Route::resource('roles', RoleController::class);

//     //Route User
//     Route::resource('users', UserController::class);

//     //Route Event
//     Route::resource('events', EventController::class);

//     //Route Contribution
//     Route::resource('contributions', ContributionController::class);

//     // get download contribution
//     Route::get('contributions/download/{id}', [ContributionController::class, 'download'])->name('contributions.download');
//     //route permissions
//     Route::resource('permissions', PermissionController::class);
//     //route comment of contribution
//     Route::get('contributions/{contribution}/comment', [ContributionController::class, 'comment'])->name('contributions.comment');
//     Route::post('contributions/{contribution}/submit-comment', [ContributionController::class, 'submitComment'])->name('contributions.submitComment');
//     Route::get('contributions/view_comment/{id}', [ContributionController::class, 'viewComment'])->name('contributions.viewComments');

//     //test mail
//     Route::get('/contact',[ContributionController::class, 'contact'])->name('contribitions.contact');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



// Route::group(['middleware' => ['auth', 'permission']],function(){

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/home',function () {
        return view('home');
    });

    //Route Faculty
    Route::resource('facultys', FacultyController::class);

    //Route Role
    Route::resource('roles', RoleController::class);

    //Route User
    Route::resource('users', UserController::class);

    //Route Event
    Route::resource('events', EventController::class);

    //Route Contribution
    Route::resource('contributions', ContributionController::class);

    // get download contribution
    Route::get('contributions/download/{id}', [ContributionController::class, 'download'])->name('contributions.download');
    //route permissions
    Route::resource('permissions', PermissionController::class);
    //route comment of contribution
    Route::get('contributions/{contribution}/comment', [ContributionController::class, 'comment'])->name('contributions.comment');
    Route::post('contributions/{contribution}/submit-comment', [ContributionController::class, 'submitComment'])->name('contributions.submitComment');
    Route::get('contributions/view_comment/{id}', [ContributionController::class, 'viewComment'])->name('contributions.viewComments');

    //test mail
    Route::get('/contact',[ContributionController::class, 'contact'])->name('contribitions.contact');
    // contribution status
    Route::put('/contributions/{id}/update-status', [ContributionController::class, 'updateStatus'])->name('contributions.updateStatus');


// });



