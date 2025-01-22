<?php

use App\Http\Controllers\AdminCompanyController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::post("/admin/login", [AdminController::class, "login"]);

Route::apiResource("/admin/company", AdminCompanyController::class)
    ->middleware("authAdmin");
