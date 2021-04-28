<?php

use App\Http\Controllers\AccessCarteController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CommandController;
use App\Http\Controllers\admin\IngredientAllergenController;
use App\Http\Controllers\admin\RecipeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutPayPalController;
use App\Http\Controllers\CheckoutStripeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderInfoController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StripePaymentController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('homepage');

Route::prefix('menu')->group(function () {
    Route::get('/', [MenuController::class, 'index'])->name('menu');
    Route::get('access', [AccessCarteController::class, 'index'])->name('access');
    Route::post('access/verification', [AccessCarteController::class, 'verification'])->name('verification.access');
});

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart');
    Route::post('add/item', [CartController::class, 'store'])->name('add.item');
    Route::post('delete/item/{id}', [CartController::class, 'destroy'])->name('delete.item');
    Route::post('less/item/{id}', [CartController::class, 'lessItem'])->name('less.item');
    Route::post('more/item/{id}', [CartController::class, 'moreItem'])->name('more.item');

    Route::get('information', [OrderInfoController::class, 'index'])->name('order.info');
    Route::get('remove', [OrderInfoController::class, 'flush_cart'])->name('order.flush');
});

Route::get('contact', [ContactController::class, 'index'])->name('contact');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::post('store/tva', [AdminController::class, 'tva_store'])->name('tva.store');

    Route::prefix('command')->group(function () {
        Route::get('/', [CommandController::class, 'index'])->name('command');
        Route::get('emporter', [CommandController::class, 'command_emporter'])->name('command.emporter');
        Route::get('livraison', [CommandController::class, 'command_livraison'])->name('command.livraison');
        Route::get('complete', [CommandController::class, 'complete'])->name('command.complete');
    });

    Route::prefix('recipe')->group(function () {
        Route::get('/', [RecipeController::class, 'index'])->name('recipe');
        Route::post('store', [RecipeController::class, 'store'])->name('recipe.store');
        Route::get('edit/{id}', [RecipeController::class, 'edit'])->name('recipe.edit');
        Route::post('update/{id}', [RecipeController::class, 'update'])->name('recipe.update');
        Route::delete('destroy/{id}', [RecipeController::class, 'destroy'])->name('recipe.destroy');
    });

    Route::prefix('ingredient-allergen')->group(function () {
        Route::get('/', [IngredientAllergenController::class, 'index'])->name('ingredient.allergen');

        Route::post('store/ingredient', [IngredientAllergenController::class, 'ingredient_store'])->name('ingredient.store');
        Route::post('edit/ingredient/{id}', [IngredientAllergenController::class, 'ingredient_edit'])->name('ingredient.edit');
        Route::post('update/ingredient/{id}', [IngredientAllergenController::class, 'ingredient_update'])->name('ingredient.update');
        Route::delete('destroy/ingredient/{id}', [IngredientAllergenController::class, 'ingredient_destroy'])->name('ingredient.destroy');

        Route::post('store/allergen', [IngredientAllergenController::class, 'allergen_store'])->name('allergen.store');
        Route::post('edit/allergen/{id}', [IngredientAllergenController::class, 'allergen_edit'])->name('allergen.edit');
        Route::post('update/allergen/{id}', [IngredientAllergenController::class, 'allergen_update'])->name('allergen.update');
        Route::delete('destroy/allergen/{id}', [IngredientAllergenController::class, 'allergen_destroy'])->name('allergen.destroy');
    });
});

Route::prefix('payment')->group(function () {
    Route::get('/', [StripePaymentController::class, 'index'])->name('payment');
    Route::post('info', [StripePaymentController::class, 'info'])->name('payment.info');
    Route::post('info/edit/{id}', [StripePaymentController::class, 'editInfo'])->name('payment.info.edit');
    Route::post('info/update/{id}', [StripePaymentController::class, 'updateInfo'])->name('payment.info.update');
    Route::post('process', [StripePaymentController::class, 'process'])->name('payment.process');
    Route::get('success', [StripePaymentController::class, 'success'])->name('payment.success');
    Route::get('cancel', [StripePaymentController::class, 'cancel'])->name('payment.cancel');
    Route::post('delete/command/{id}', [StripePaymentController::class, 'deleteCommand'])->name('payment.delete.command');
    Route::any('complete', [StripePaymentController::class, 'complete'])->name('payment.complete');
});

Route::get('contact', [ContactController::class, 'index'])->name('contact');

require __DIR__ . '/auth.php';
