<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Blog\BlogCatController;
use App\Http\Controllers\Admin\Blog\BlogCommentController;
use App\Http\Controllers\Admin\Blog\BlogPostController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactDetailController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\HomepageController;
use App\Http\Controllers\Admin\Project\ProjectCatController;
use App\Http\Controllers\Admin\Project\ProjectPostController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\TeamsController;
use App\Http\Controllers\Admin\TestimonialController;
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

    // Route::get('/teams', 'getTeams')->name('teams');
    // Route::post('/team/update/{id}', 'postTeam')->name('team.update');

    // Route::get('/services', 'getServices')->name('services');
    // Route::post('/services/update/{id}', 'postServices')->name('services.update');

    // Route::get('/testimonials', 'getTestimonials')->name('testimonials');
    // Route::post('/testimonials/update/{id}', 'postTestimonials')->name('testimonials.update');

    // Route::get('/faqs', 'getFaq')->name('faqs');
    // Route::post('/faqs/update/{id}', 'postFaq')->name('faqs.update');

    // Route::get('/clients', 'getClients')->name('clients');
    // Route::post('/clients/update/{id}', 'postClients')->name('clients.update');

    // Blog Categories
    // Route::get('blog/categories', [BlogCatController::class, 'index'])->name('blog.categories');
    // Route::post('blog/category/add', [BlogCatController::class, 'store'])->name('blog.category.add');
    // Route::any('blog/category/update/{id}', [BlogCatController::class, 'update'])->name('blog.category.update');
    // Route::get('blog/category/{id}', [BlogCatController::class, 'show'])->name('blog.category.show');
    // Route::get('blog/category/delete/{id}', [BlogCatController::class, 'destroy'])->name('blog.category.delete');



    Route::resource('contactmessages', ContactMessageController::class);
    Route::resource('contactdetails', ContactDetailController::class);

    //Blog
    Route::resource('blogcategories', BlogCatController::class);
    Route::resource('blogpost', BlogPostController::class);

    //Blog Comments
    Route::get('comments', [BlogCommentController::class, 'index'])->name('blog.comments');
    Route::get('comments/approve/{id}', [BlogCommentController::class, 'approve'])->name('blog.comments.update');
    Route::get('comments/reject/{id}', [BlogCommentController::class, 'reject'])->name('blog.comments.update');

    Route::resource('projectcat', ProjectCatController::class);
    Route::resource('project', ProjectPostController::class);
    Route::resource('teams', TeamsController::class);

    Route::resource('services', ServicesController::class);
    Route::resource('faqs', FaqController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('testimonials', TestimonialController::class);
});
