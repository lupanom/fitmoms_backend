<?php

use App\Models\Day;
use App\Models\Mother;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::firstWhere('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    $day = Day::firstwhere(['date' => Carbon::today(), 'mother_id' => $user->mother->id]);

    if (!$day) {
        $day = Day::create([
            'mother_id' => $user->mother->id,
            'date' => Carbon::today(),
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});

Route::get('/sanctum/register', function (Request $request) {

        $attr = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $attr['name'],
            'password' => bcrypt($attr['password']),
            'email' => $attr['email']
        ]);

        $mother = Mother::create([
            'name' => $user->name,
            'user_id' => $user->id,
        ]);

        $day = Day::firstwhere(['date' => Carbon::today(), 'mother_id' => $mother->id]);

        if (!$day) {
            $day = Day::create([
                'mother_id' => $mother->id,
                'date' => Carbon::today(),
            ]);
        }

        return ['token' => $user->createToken('API Token')->plainTextToken];

});
