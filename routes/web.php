<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


// Routes concernant la partie cliente

Route::get('/', [ClientController::class, 'home']);
// Route::get('/', 'ClientController@home');

Route::get('/shop', [ClientController::class, 'shop']);

Route::get('/panier', [ClientController::class, 'panier']);

Route::get('/paiement', [ClientController::class, 'paiement']);

Route::get('/client_login', [ClientController::class, 'client_login']);

Route::get('/signup', [ClientController::class, 'signup']);



// Routes concernant la partie administrateur

Route::get('/admin', [AdminController::class, 'dashboard']);
Route::get('/commandes', [AdminController::class, 'commandes']);

Route::get('/ajoutercategorie', [CategoryController::class, 'ajoutercategorie']);
Route::post('/sauvercategorie', [CategoryController::class, 'sauvercategorie']);
Route::get('/categories', [CategoryController::class, 'categories']);
Route::get('/edit_categorie/{id}', [CategoryController::class, 'edit_categorie']);
Route::post('/modifiercategorie', [CategoryController::class, 'modifiercategorie']);
Route::get('/supprimercategorie/{id}', [CategoryController::class, 'supprimercategorie']);


Route::get('/ajouterproduit', [ProductController::class, 'ajouterproduit']);
Route::post('/sauverproduit', [ProductController::class, 'sauverproduit']);
Route::get('/produits', [ProductController::class, 'produits']);
Route::get('/edit_produit/{id}', [ProductController::class, 'edit_produit']);
Route::post('/modifierproduit', [ProductController::class, 'modifierproduit']);
Route::get('/supprimerproduit/{id}', [ProductController::class, 'supprimerproduit']);
Route::get('/activer_produit/{id}', [ProductController::class, 'activer_produit']);
Route::get('/desactiver_produit/{id}', [ProductController::class, 'desactiver_produit']);


Route::get('/ajouterslider', [SliderController::class, 'ajouterslider']);
Route::post('/sauverslider', [SliderController::class, 'sauverslider']);
Route::get('/sliders', [SliderController::class, 'sliders']);
Route::get('/edit_slider/{id}', [SliderController::class, 'edit_slider']);
Route::post('/modifierslider', [SliderController::class, 'modifierslider']);
Route::get('/supprimerslider/{id}', [SliderController::class, 'supprimerslider']);
Route::get('/activer_slider/{id}', [SliderController::class, 'activer_slider']);
Route::get('/desactiver_slider/{id}', [SliderController::class, 'desactiver_slider']);






