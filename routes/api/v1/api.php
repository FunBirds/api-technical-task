<?php

use App\Http\Controllers\AdminCompanyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyUsersController;
use Illuminate\Support\Facades\Route;

#----- Admin -----#
Route::post("/admin/login", [AdminController::class, "login"]);

Route::apiResource("/admin/company", AdminCompanyController::class)
    ->middleware("authAdmin")
    ->names('admin.company');

#----- Company -----#
Route::post("/company/login", [CompanyController::class, "login"]);

Route::apiResource("/company", CompanyController::class)
    ->except(["index", "store"])
    ->middleware("authCompany")
    ->names('company.details');

Route::apiResource("/employee", CompanyUsersController::class)
    ->middleware("authCompany")
    ->names('company.employee');
