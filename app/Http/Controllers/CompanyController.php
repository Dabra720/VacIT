<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function show_company(Request $request){
        $company_id = $request->get('id');
        $company = Company::where('id', $company_id)->first();
        return response()->json([
            'company' => $company
        ], 200);
    }
}
