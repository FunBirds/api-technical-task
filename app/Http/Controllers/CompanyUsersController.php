<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyAddUserRequest;
use App\Http\Requests\UpdateCompanyUserRequest;
use App\Http\Resources\ShowCompanyEmployeeByIndex;
use App\Http\Resources\ShowUserResource;
use App\Models\User;
use App\Services\ShowCompanyUsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompanyUsersController extends Controller
{
    public function __construct(protected ShowCompanyUsersService $showCompanyUsersService){}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return ShowCompanyEmployeeByIndex::collection($this->showCompanyUsersService->showCompanyUsers($request));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyAddUserRequest $request)
    {
        $validated = $request->validated();

        $data = [
            'u_passportNumber' => $validated['passportNumber'],
            'u_name' => $validated['name'],
            'u_surname' => $validated['surname'],
            'u_middle_name' => $validated['middle_name'],
            'u_position' => $validated['position'],
            'u_phone' => $validated['phone'],
            'u_address' => $validated['address'],
            'u_company_id' => $validated['company_id'],
            'remember_token'=> Str::random(25)
        ];
        User::create($data);
        return response()->json([
            'code' => 201,
            'message' => 'User created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $user_id)
    {
        return new ShowUserResource($this->showCompanyUsersService->showUser($user_id, $request));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyUserRequest $request, User $user)
    {
        $validated = $request->validated();

        $data = [
            'u_passportNumber' => $validated['passportNumber'] ?? $user->u_passportNumber,
            'u_name' => $validated['name'] ?? $user->u_name,
            'u_surname' => $validated['surname'] ?? $user->u_surname,
            'u_middle_name' => $validated['middle_name'] ?? $user->u_middle_name,
            'u_position' => $validated['position'] ?? $user->u_position,
            'u_phone' => $validated['phone'] ?? $user->u_phone,
            'u_address' => $validated['address'] ?? $user->u_address,
            'u_company_id' => $validated['company_id'] ?? $user->u_company_id,
        ];
        $user->update($data);
        return response()->json([
            'code' => 200,
            'message' => 'User updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'code' => 200,
            'message' => 'User deleted successfully'
        ]);
    }
}
