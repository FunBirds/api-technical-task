<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::post("/admin/login", [AdminController::class, "login"]);
