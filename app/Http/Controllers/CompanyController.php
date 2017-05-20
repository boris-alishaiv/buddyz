<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function getAllCompanies($userId)
    {

        $companies = Company::where("user_id", $userId)->get();
        return response()->json($companies, 200);
    }

    public function addCompany($userId, Request $request)
    {
        // TODO: admin only

        if (Company::where('name', $request['name'])->first()){
            return response()->json('Company name already exist',405);
        }

        $company = new Company();
        $company->user_id = $userId;
        $company->name = $request['name'];
        $company->location = $request['location'];
        $company->company_number = $request['companyNumber'];
        $company->info = $request['info'];
        $company->type = $request['type'];
        $company->facebook_url = $request['facebookURL'];
        $company->linkedIn_url = $request['linkedInURL'];
        $company->save();

        return response()->json('successful operation',200);
    }

    public function getCompany($userId, $companyId)
    {
        if ($company = Company::where('id', $companyId)->where('user_id', $userId)->first()) {
            return response()->json($company,200);
        }

        return response()->json('Invalid Company id',404);
    }

    public function updateCompany($userId, $companyId, Request $request)
    {
        // TODO: add path to auth
//        $user = JWTAuth::parseToken()->toUser();

//        if (Company::find($companyId)->user_id != $user->id){
//            return response()->json('Permission denied',400);
//        }

        if (! $company = Company::where('id', $companyId)->where('user_id', $userId)->first()) {
            return response()->json('Company not found',404);
        }

        if (isset($request['name']))  $company->name = $request['name'];
        if (isset($request['company_number'])) $company->description = $request['company_number'];
        if (isset($request['location'])) $company->description = $request['location'];
        if (isset($request['info'])) $company->description = $request['info'];
        if (isset($request['type'])) $company->description = $request['type'];
        if (isset($request['facebookURL'])) $company->description = $request['facebookURL'];
        if (isset($request['linkedInURL'])) $company->description = $request['linkedInURL'];
        $company->save();

        return response()->json('successful operation',202);
    }

    public function deleteCompany($userId, $companyId)
    {
        // TODO: admin only

        if (! $company = Company::where('id', $companyId)->where('user_id', $userId)->first()) {
            return response()->json('Company not found',404);
        }

        $company->delete();
        return response()->json('successful operation',202);
    }
}
