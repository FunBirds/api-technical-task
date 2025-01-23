<?php

namespace App\Traits\Company;

use App\Http\Requests\CompanyUpdateRequest;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

trait CompanyHelper
{
    /**
     * Update the specified resource in database [companies].
     * is will be used as alternative of update function in the controller AdminCompanyController && CompanyController
     */
    public function update(CompanyUpdateRequest $request, Company $company): JsonResponse
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
            $data['c_logo'] = $this->makeImageUrl($filename);
        }
        #----- Company Logo Update [END] -----#
        $company->update($data);

        return response()->json([
            'code'=>200,
            'message' => 'Company updated successfully'
        ]);
    }

    protected function makeImageUrl($image) : string
    {
        $app_env = config("services.env");
        $url = "";
        if (!empty($image)) {
            if ($app_env == "local") {
                $url = url("/storage/app/private/public/companies/logo/" . $image);
            } else {
                $url = config("services.url") . "/attachments/companies/logo/" . $image;
            }
        }
        return $url;
    }
}
