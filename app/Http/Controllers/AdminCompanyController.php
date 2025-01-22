<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Http\Resources\CompanyShowResource;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class AdminCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CompanyShowResource::collection(Company::paginate(50));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyStoreRequest $request)
    {
        $validated = $request->validated();
        $data = [
            'c_name' => $validated['name'],
            'c_owner' => $validated['owner'],
            'c_address' => $validated['address'],
            'c_email' => $validated['email'],
            'c_website' => $validated['website'],
            'c_phone' => $validated['phone'],
            'c_password' => bcrypt($validated['password']),
        ];
        #----- Company Logo Download [START] -----#
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename =  $validated["name"] . time() . '.' . $extension;
            Storage::putFileAs(
                'public/companies/logo',
                $file,
                $filename
            );
            $data['c_logo'] = $filename;
        }
        #----- Company Logo Download [END] -----#

        Company::create($data);

        return response()->json([
            'code'=>201,
            'message' => 'Company created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return new CompanyShowResource($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        $validated = $request->validated();

        $data = [
            'c_name' => $validated['name'] ?? $company->c_name,
            'c_owner' => $validated['owner'] ?? $company->c_owner,
            'c_address' => $validated['address'] ?? $company->c_address,
            'c_email' => $validated['email'] ?? $company->c_email,
            'c_website' => $validated['website'] ?? $company->c_website,
            'c_phone' => $validated['phone'] ?? $company->c_phone,
        ];

        if (isset($validated['password'])) {
            $data['c_password'] = bcrypt($validated['password']);
        }

        #----- Company Logo Update [START] -----#
        if ($request->hasFile('logo')) {
            if ($company->c_logo && file_exists(storage_path('public/companies/logo' . $company->c_logo))) {
                unlink(storage_path('public/companies/logo' . $company->c_logo));
            }

            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = $data["c_name"] . time() . '.' . $extension;
            Storage::putFileAs(
                'public/companies/logo',
                $file,
                $filename
            );
            $data['c_logo'] = $filename;
        }
        #----- Company Logo Update [END] -----#
        $company->update($data);

        return response()->json([
            'code'=>200,
            'message' => 'Company updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        if ($company->c_logo && file_exists(storage_path('public/companies/logo' . $company->c_logo))) {
            unlink(storage_path('public/companies/logo' . $company->c_logo));
        }
        $company->delete();

        return response()->json([
            'code'=>200,
            'message' => 'Company deleted successfully'
        ]);
    }
}
