<?php

use App\Http\Controllers\ExpencesController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckHr;
use App\Http\Middleware\CheckUser;
use App\Http\Middleware\PreventBackHistory;

// Route::get('/pdf', function(){
//     return view("finance.pdf_view");
// });

Route::get('/', "Auth\LoginController@showLoginForm")->name('login');

Route::middleware([PreventBackHistory::class])->group(function() {
    Auth::routes();
    
    Route::get("/notFound", function() {
        return view("notFound");
    })->name("notFound");

    //all users routes
    Route::get('/dashboard', 'HomeController@index')->name('home')->middleware("userActivation");
    Route::get('/profile', "ProfilesController@index")->name('profile');
    Route::get('/expenses', 'ExpencesController@index')->name('expenses');
    Route::get('/expences/fetch', 'ExpencesController@fetch')->name('getExpences');
    Route::delete("expences/delete/{id}", "ExpencesController@delete")->name("deleteExps");
    Route::post('/expences/cancelled', 'ExpencesController@cancelled')->name('getCancelledExps');
    Route::post('/expences/create', 'ExpencesController@create')->name('createExpences');
    Route::post('/user/approved', 'ExpencesController@userApproved')->name('userApproved');
    Route::post('/approved/cancelled', 'ExpencesController@cancelledViewed')->name('cancelledViewed');
    //Aunthentication routes
    Route::post('/edit/user/info', "Auth\RegisterController@editUserInfo")->name('editUserInfo');
    Route::post('/edit/user/password', "Auth\RegisterController@editUserPassword")->name('editUserPassword');
    //Project routes
    Route::get("/projects", "ProjectsController@index")->name("projects");
    Route::post("/project/expenses/create", "ProjectsController@create")->name("createProject");
    //Projects Expenses routes
    Route::get("/projects/expenses", "ProjectExpencesController@index")->name("project-expenses");

    // hr or admin routes only
    Route::middleware([CheckHr::class])->group(function() {
        //auth routes
        Route::post('/user/action', "Auth\RegisterController@userActions")->name("userActions");
        Route::get("/fetch/users", "Auth\RegisterController@fetchUsers")->name("fetchUsers");
        Route::get("/register", "Auth\RegisterController@showRegistrationForm")->name("register");
        Route::post("/register", "Auth\RegisterController@register");
        //expenses routes
        Route::get('/expences/pending', 'ExpencesController@pending')->name('getPendingExps');
        Route::get("/expenses/clarify", "ExpencesController@clarify")->name("clarifyExps");
        Route::post('/expences/recommended', 'ExpencesController@recommend')->name('recommendExpence');
        Route::post('/expences/decline', 'ExpencesController@decline')->name('declineExpence');
        Route::post('/expences/revised', 'ExpencesController@revised')->name('revisedExpence');
        Route::get('/fetch/expenses/accepted', 'ExpencesController@getAccepted')->name("getAccepted");
        Route::post('/expenses/cashOut', 'ExpencesController@cashOut')->name('cashOut');
        Route::post('/expenses/approved/month', 'ExpencesController@approved')->name('approved');
        
        Route::post(("/expenses/seen"), "ExpencesController@viewed")->name("viewed");
        Route::get('/expense/printPdf/{month}', ['as' => 'printPdf', 'uses' => 'ExpencesController@printPDF']);
    });

    //Admin routes only
    Route::middleware([CheckUser::class])->group(function() {
        Route::post('/expences/accept', 'ExpencesController@accept')->name('accept');
        Route::post('/expences/admin/decline', 'ExpencesController@adminDecline')->name('adminDecline');
        Route::get('/fetch/recommended/expenses', 'ExpencesController@hrRecommendation')->name('hrRecommendation');
        Route::get("/fetch/revised", "ExpencesController@getRevised")->name("getRevised");
    });
});

