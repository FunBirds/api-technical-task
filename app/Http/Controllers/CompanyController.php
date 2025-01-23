<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyLoginRequest;
use App\Http\Resources\CompanyLoginSuccessResource;
use App\Http\Resources\CompanyShowResource;
use App\Models\Company;
use App\Traits\Company\CompanyHelper;

class CompanyController extends Controller
{
    use CompanyHelper;
    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return new CompanyShowResource($company->load("users"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return response()->json([
            'code' => 200,
            'message' => 'Company deleted successfully'
        ]);
    }

    #----- Company Login [START] -----#
    public function login(CompanyLoginRequest $request)
    {
        $validated = $request->validated();
        $company = Company::where('c_email', $validated['email'])->first();
        if (!$company || !password_verify($validated['password'], $company->c_password)) {
            return response()->json([
                'code' => 401,
                'message' => 'Unauthorized'
            ]);
        }
        return new CompanyLoginSuccessResource($company);
    }
    #----- Company Login [END] -----#
}
