<?php

use App\Models\Item;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    $items = Item::all();
    return view('welcome', ["items" => $items]);
});

// Render registration form
Route::get("/register", function () {
    return view("registerform");
});

// Render Login form
Route::get("/login", function () {
    return view("loginform");
});

Route::get("/edit", function () {
    return view("edit");
});


// Handle user registration request
Route::post("/register", [UserController::class, "register"]);

// Login to an existing Account
Route::post("/login", [UserController::class, "login"]);


// logout
Route::post("/logout", [UserController::class, "logout"]);

// creat an item
Route::post("/create", [ItemController::class, "create"]);

// edit an item 
Route::get("/edit-item/{item}", [ItemController::class, "editItem"]);
Route::put("/edit-item/{item}", [ItemController::class, "updateItem"]);

// delete the item
Route::delete("/delete/{item}", [ItemController::class, "deleteItem"]);
