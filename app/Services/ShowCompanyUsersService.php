<?php

namespace App\Services;

use App\Models\Company;
use App\Models\User;
use App\Traits\Helpers\TokenParser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelIdea\Helper\App\Models\_IH_User_C;

class ShowCompanyUsersService
{
    use TokenParser;

    public function showCompanyUsers(Request $request)
    {
        $token = $this->parseToken($request);
        $company = $this->getCompany($token);
        return User::where("u_company_id", $company->c_id)
            ->paginate(25);
    }

    public function showUser($user_id, Request $request): User|JsonResponse
    {
        $token = $this->parseToken($request);
        $company = $this->getCompany($token);

        $user = User::findOrFail($user_id);
        if ($user->u_company_id !== $company->c_id){
            return response()->json([
                'code' => 403,
                'message' => 'Action is forbidden'
            ], 403);
        }
        return $user->load("company");
    }


    # ------------------- Private functions -------------------#

    private function getCompany(string $token): Company|JsonResponse
    {
        $company = Company::where('remember_token', $token)?->first();
        if (!$company){
            return response()->json([
                'code' => 404,
                'message' => 'There\'s no company with this token'
            ], 404);
        }
        return $company;
    }
}
