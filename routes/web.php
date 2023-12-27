<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\EquipierController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\QuizzController;
use App\Http\Controllers\QuizzImageController;
use App\Http\Controllers\QCMController;
use App\Http\Controllers\VraiFauxController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// routes statiques
Route::get('/', [EquipierController::class, 'indexPublic'])->name('home');
Route::get('/programme', [EvenementController::class, 'indexPublic'])->name('programme');
Route::get('/galerie', [AlbumController::class, 'indexPublic'])->name('galerie');
Route::get('/galerie/{id}', [AlbumController::class, 'show'])->name('album');
Route::get('/contact', function (ContactController $contactController,) {
    $evenements = $contactController->index(); 
    return Inertia::render('Contact', [
        'evenements'=>$evenements,
    ]);
})->name('contact');
Route::get('/quizz', [QuizzController::class, 'indexPublic'])->name('quizz');

Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');
Route::resource('newsletter',NewsletterController::class);
Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

Route::get('/register',function(){
    return Inertia::render('Register',[
    ]);
})->name('register');
Route::inertia('/mentions','Mentions');
Route::inertia('/policy','Policy');
Route::fallback(function () {
    return Inertia::render('404');
});

// routes admin
Route::middleware('auth')->prefix('admin')->group(function(){

    Route::get('/',function(){
        return Inertia::render('Admin/Panel',[
        ]);
    })->name('admin');

    Route::resource('images', ImageController::class);
    
    // Routes pour l'entité "album"
    Route::resource('albums', AlbumController::class);
    
    // Routes pour l'entité "equipier"
    Route::resource('equipe', EquipierController::class);
    
    // Routes pour l'entité "evenement"
    Route::resource('evenements', EvenementController::class);

    Route::resource('newsletter', NewsletterController::class);

    Route::post('evenements/recurring', [EvenementController::class, 'createRecurringEvent'])->name('evenements.recurring');
    
    // Routes pour l'entité "quizz"
    Route::resource('quizz', QuizzController::class);
    Route::resource('qcm', QCMController::class);
    Route::resource('vraifaux', VraiFauxController::class);
    Route::resource('quizzimage', QuizzImageController::class);
    });

require __DIR__.'/auth.php';