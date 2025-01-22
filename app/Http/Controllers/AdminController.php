<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginRequest;
use App\Http\Resources\AdminLoginSuccessResource;
use App\Models\Admin;


class AdminController extends Controller
{
    public function login(AdminLoginRequest $request)
    {
        $validated = $request->validated();
        $email = $validated["email"];
        $password = $validated["password"];

        $admin = Admin::where("a_email", $email)->first();

        if (!$admin) {
            return response()->json(
                ["message" => "Invalid email, please check and try again"], 400
            );
        }

        if (!password_verify($password, $admin->a_password)) {
            return response()->json(
                ["message" => "Invalid password, please check and try again"], 400
            );
        }

        return new AdminLoginSuccessResource($admin);
    }
}
