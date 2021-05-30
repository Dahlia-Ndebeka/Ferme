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
// Route::post('/sauvercategorie', [CategoryController::class, 'sauvercategorie']);
Route::post('/sauvercategorie', 'CategoryController@sauvercategorie');
Route::get('/categories', [CategoryController::class, 'categories']);


Route::get('/ajouterproduit', [ProductController::class, 'ajouterproduit']);
Route::post('/sauverproduit', [ProductController::class, 'sauverproduit']);
// Route::post('/sauverproduit', 'ProductController@sauverproduit');
Route::get('/produits', [ProductController::class, 'produits']);


Route::get('/ajouterslider', [SliderController::class, 'ajouterslider']);
Route::post('/sauverslider', [SliderController::class, 'sauverslider']);
// Route::post('/sauverslider', 'ProductController@sauverslider');
Route::get('/sliders', [SliderController::class, 'sliders']);



