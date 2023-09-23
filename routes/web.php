<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomepageController;
use App\Http\Controllers\FrontpageController;
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

Route::controller(FrontpageController::class)
    ->group(function(){

    Route::get('/', 'index')->name('index');
    Route::get('/about', 'about')->name('about');
    Route::get('/team', 'team')->name('team');
    Route::get('/services', 'services')->name('services');
    Route::get('/projects', 'projects')->name('projects');
    Route::get('/contact', 'contact')->name('contact');

    Route::post('/contact/send', 'postContact')->name('contact.send');



});
Auth::routes();


Route::controller(AdminController::class)
    ->prefix('admin')->name('admin.')
    ->middleware('auth')
    ->group(function(){

    Route::get('/dashboard', 'index')->name('index');

    Route::controller(HomepageController::class)
    ->prefix('frontpage')->name('frontpage.')

    ->group(function(){
        Route::get('/slider', 'getSlider')->name('slider');
        Route::post('/slider/update/{id}', 'postSlider')->name('slider.update');

        Route::get('/services', 'getServices')->name('services');
        Route::post('/service/update/{id}', 'postService')->name('service.update');

        Route::get('/about', 'getAbout')->name('about');
        Route::post('/about/update/{id}', 'postAbout')->name('about.update');
    });


    Route::get('/about', 'getAbout')->name('about');
    Route::post('/about/update/{id}', 'postAbout')->name('about.update');

    Route::get('/teams', 'getTeams')->name('teams');
    Route::post('/team/update/{id}', 'postTeam')->name('team.update');

    Route::get('/services', 'getServices')->name('services');
    Route::post('/services/update/{id}', 'postServices')->name('services.update');

    Route::get('/testimonials', 'getTestimonials')->name('testimonials');
    Route::post('/testimonials/update/{id}', 'postTestimonials')->name('testimonials.update');

    Route::get('/faqs', 'getFaq')->name('faqs');
    Route::post('/faqs/update/{id}', 'postFaq')->name('faqs.update');

    Route::get('/clients', 'getClients')->name('clients');
    Route::post('/clients/update/{id}', 'postClients')->name('clients.update');


    

});
