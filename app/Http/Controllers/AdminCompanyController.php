<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Http\Resources\CompanyShowIndexResource;
use App\Http\Resources\CompanyShowResource;
use App\Models\Company;
use App\Traits\Company\CompanyHelper;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminCompanyController extends Controller
{
    use CompanyHelper;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CompanyShowIndexResource::collection(Company::paginate(50));
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
            'remember_token' => Str::random(25)
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
            $data['c_logo'] = $this->makeImageUrl($filename);
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
        $company->load("users");
        return new CompanyShowResource($company);
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
