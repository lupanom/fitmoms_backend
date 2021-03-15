<?php

use App\Http\Controllers\DrinkController;
use App\Http\Controllers\ExerciseCategoryController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ExerciseProgramController;
use App\Http\Controllers\FoodCategoryController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\MotherController;
use App\Http\Controllers\MotherDaysController;
use App\Http\Controllers\MotherDrinksController;
use App\Http\Controllers\MotherExercisesController;
use App\Http\Controllers\MotherFoodController;
use App\Http\Controllers\MotherFoodDrinksController;
use App\Http\Controllers\MotherWeightsController;
use App\Http\Controllers\UserController;
use App\Models\Day;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    $day = Day::firstwhere('date', Carbon::today());

    if (!$day) {
        Day::create([
            'date' => Carbon::today(),
            'mother_id' => $request->user()->mother->id,
        ]);
    }
    return $request->user();
});

Route::get('/users/{user}', [UserController::class, 'show']);

Route::get('/mothers/{mother}', [MotherController::class, 'update']);
Route::get('/mothers', [MotherController::class, 'index']);

Route::get('/mothers/{mother}/exercises', [MotherExercisesController::class, 'today']);
Route::get('/mothers/{mother}/exercises/{exercise}', [MotherExercisesController::class, 'store']);
Route::get('/mothers/{mother}/exercises-all', [MotherExercisesController::class, 'index']);

Route::get('/mothers/{mother}/food/{food}', [MotherFoodController::class, 'store']);
Route::get('/mothers/{mother}/food', [MotherFoodController::class, 'today']);
Route::get('/mothers/{mother}/food-all', [MotherFoodController::class, 'index']);
Route::get('/mothers/{mother}/delete-food/{food}', [MotherFoodController::class, 'delete']);

Route::get('/mothers/{mother}/drinks/{drink}', [MotherDrinksController::class, 'store']);
Route::get('/mothers/{mother}/drinks', [MotherDrinksController::class, 'index']);

Route::get('/mothers/{mother}/food-and-drinks', [MotherFoodDrinksController::class, 'index']);

// tutti i giorni in cui la mamma ha usato l'app (in ordine dal più vecchio)
Route::get('/mothers/{mother}/days', [MotherDaysController::class, 'index']);
// oggi e i 6 giorni precedenti (in ordine dal più vecchio)
Route::get('/mothers/{mother}/week', [MotherDaysController::class, 'week']);
// oggi e i 29 giorni precedenti (in ordine dal più vecchio)
Route::get('/mothers/{mother}/month', [MotherDaysController::class, 'month']);

// salva il nuovo peso
Route::get('/mothers/{mother}/weight', [MotherWeightsController::class, 'store']);


// tutte le categorie di esercizi
Route::get('/exercise-categories', [ExerciseCategoryController::class, 'index']);
// la singola categoria
Route::get('/exercise-categories/{exerciseCategory}', [ExerciseCategoryController::class, 'show']);
// i primi 4 esercizi di una categoria
Route::get('/exercise-categories/{exerciseCategory}/exercises', [ExerciseCategoryController::class, 'exercises']);


// tutti i programmi di allenamento
Route::get('/exercise-programs', [ExerciseProgramController::class, 'index']);
// il singolo programma di allenamento
Route::get('/exercise-programs/{exerciseProgram}', [ExerciseProgramController::class, 'show']);
// i primi 4 esercizi di un programma di allenamento
Route::get('/exercise-programs/{exerciseProgram}/exercises', [ExerciseProgramController::class, 'exercises']);
Route::get('/exercise-programs/{exerciseProgram}/exercise/{exercise}', [ExerciseProgramController::class, 'next']);


Route::get('/exercises', [ExerciseController::class, 'index']);
Route::get('/exercises/{exercise}', [ExerciseController::class, 'show']);


Route::get('/food', [FoodController::class, 'index']);
Route::get('/food/{food}', [FoodController::class, 'show']);
Route::post('/food', [FoodController::class, 'store']);

Route::get('/food-categories', [FoodCategoryController::class, 'index']);
Route::get('/food-categories/{food_category}/food', [FoodCategoryController::class, 'food']);

Route::get('/drinks', [DrinkController::class, 'index']);
Route::get('/drinks/add', [DrinkController::class, 'store']);


