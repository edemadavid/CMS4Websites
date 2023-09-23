<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FrontpageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::controller(AdminController::class)
    ->prefix('admin')->name('admin.')
    ->middleware('auth')
    ->group(function(){

    Route::get('/dashboard', 'index')->name('index');


    // Route::get('/about', 'getAbout')->name('about');
    // Route::get('/teams', 'getTeams')->name('teams');

    // Route::get('/services', 'getServices')->name('services');
    // Route::get('/testimonials', 'getTestimonials')->name('testimonials');
    // Route::get('/faqs', 'getFaq')->name('faqs');
    // Route::get('/clients', 'getClients')->name('clients');

    Route::controller(FrontpageController::class)
    ->prefix('front')->name('frontpage.')

    ->group(function(){
        Route::get('/slider', 'getSlider')->name('slider');

    });

});
