<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\UniteController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\FournisseurController;
use App\Http\Controllers\Api\CommandeachatController;
use App\Http\Controllers\Api\ReceptionController;
use App\Http\Controllers\Api\FactureFournisseurController;
use App\Http\Controllers\Api\ReglementFounisseurController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\DevisController;
use App\Http\Controllers\Api\CommmandeclientController;
use App\Http\Controllers\Api\LivraisonController;
use App\Http\Controllers\Api\UserController;

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

Route::post('connexion', [UserController::class, 'connexion'])->name('connexion');

Route::group(["middleware" => ["auth:sanctum"]], function () {
    Route::prefix("utilisateurs")->name("utilisateurs.")->group(function () {
        Route::get("/", [UserController::class, 'index'])->name('index');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('categories')
        ->name('categories.')
        ->group(function () {
            Route::get('/', [CategorieController::class, 'index'])->name('index');
            Route::post('/', [CategorieController::class, 'store'])->name('store');
            Route::get('/{categorie}', [CategorieController::class, 'show'])->name('show');
            Route::put('/{categorie}', [CategorieController::class, 'update'])->name('update');
            Route::delete('/{categorie}', [CategorieController::class, 'destroy'])->name('destroy');
        });
    Route::prefix('unites')->name('unites.')->group(function () {
        Route::get('/', [UniteController::class, 'index'])->name('index');
        Route::post('/', [UniteController::class, 'store'])->name('store');
        Route::get('/{unite}', [UniteController::class, 'show'])->name('show');
        Route::put('/{unite}', [UniteController::class, 'update'])->name('update');
        Route::delete('/{unite}', [UniteController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('articles')->name('articles.')->group(function () {
        Route::get('/', [ArticleController::class, 'index'])->name('index');
        Route::post('/', [ArticleController::class, 'store'])->name('store');
        Route::get('/{article}', [ArticleController::class, 'show'])->name('show');
        Route::put('/{article}', [ArticleController::class, 'update'])->name('update');
        Route::delete('/{article}', [ArticleController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('fournisseurs')->name('fournisseurs.')->group(function () {
        Route::get('/', [FournisseurController::class, 'index'])->name('index');
        Route::post('/', [FournisseurController::class, 'store'])->name('store');
        Route::get('/{fournisseur}', [FournisseurController::class, 'show'])->name('show');
        Route::put('/{fournisseur}', [FournisseurController::class, 'update'])->name('update');
        Route::delete('/{fournisseur}', [FournisseurController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('commandeachats')->name('commandeachats.')->group(function () {
        Route::get('/', [CommandeachatController::class, 'index'])->name('index');
        Route::post('/', [CommandeachatController::class, 'store'])->name('store');
        Route::get('/{commandeachat}', [CommandeachatController::class, 'show'])->name('show');
        Route::put('/{commandeachat}', [CommandeachatController::class, 'update'])->name('update');
        Route::delete('/{commandeachat}', [CommandeachatController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('receptions')->name('receptions.')->group(function () {
        Route::get('/', [ReceptionController::class, 'index'])->name('index');
        Route::post('/', [ReceptionController::class, 'store'])->name('store');
        Route::get('/{reception}', [ReceptionController::class, 'show'])->name('show');
        Route::put('/{reception}', [ReceptionController::class, 'update'])->name('update');
        Route::delete('/{reception}', [ReceptionController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('facturefournisseurs')->name('facturefournisseurs.')->group(function () {
        Route::get('/', [FactureFournisseurController::class, 'index'])->name('index');
        Route::post('/', [FactureFournisseurController::class, 'store'])->name('store');
        Route::get('/{facturefournisseur}', [FactureFournisseurController::class, 'show'])->name('show');
        Route::put('/{facturefournisseur}', [FactureFournisseurController::class, 'update'])->name('update');
        Route::delete('/{facturefournisseur}', [FactureFournisseurController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('reglementfournisseurs')->name('reglementfournisseurs.')->group(function () {
        Route::get('/', [ReglementFounisseurController::class, 'index'])->name('index');
        Route::post('/', [ReglementFounisseurController::class, 'store'])->name('store');
        Route::get('/{reglementfournisseur}', [ReglementFounisseurController::class, 'show'])->name('show');
        Route::put('/{reglementfournisseur}', [ReglementFounisseurController::class, 'update'])->name('update');
        Route::delete('/{reglementfournisseur}', [ReglementFounisseurController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('clients')->name('clients.')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('index');
        Route::post('/', [ClientController::class, 'store'])->name('store');
        Route::get('/{client}', [ClientController::class, 'show'])->name('show');
        Route::put('/{client}', [ClientController::class, 'update'])->name('update');
        Route::delete('/{client}', [ClientController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('devis')->name('devis.')->group(function () {
        Route::get('/', [DevisController::class, 'index'])->name('index');
        Route::post('/', [DevisController::class, 'store'])->name('store');
        Route::get('/{devis}', [DevisController::class, 'show'])->name('show');
        Route::put('/{devis}', [DevisController::class, 'update'])->name('update');
        Route::delete('/{devis}', [DevisController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('commandeclients')->name('commandeclients.')->group(function () {
        Route::get('/', [CommmandeclientController::class, 'index'])->name('index');
        Route::post('/', [CommmandeclientController::class, 'store'])->name('store');
        Route::get('/{commandeclient}', [CommmandeclientController::class, 'show'])->name('show');
        Route::put('/{commandeclient}', [CommmandeclientController::class, 'update'])->name('update');
        Route::delete('/{commandeclient}', [CommmandeclientController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('livraisons')->name('livraisons.')->group(function () {
        Route::get('/', [LivraisonController::class, 'index'])->name('index');
        Route::post('/', [LivraisonController::class, 'store'])->name('store');
        Route::get('/{livraison}', [LivraisonController::class, 'show'])->name('show');
        Route::put('/{livraison}', [LivraisonController::class, 'update'])->name('update');
        Route::delete('/{livraison}', [LivraisonController::class, 'destroy'])->name('destroy');
    });
});
