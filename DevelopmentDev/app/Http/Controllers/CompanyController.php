<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Models\User;
use App\Helpers\BT;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::with(['users' => function ($query) {
            $query->where('kind_person', true);
        }])->paginate(10);
        $companies = Company::with('documents');
        return inertia('Company/HomeCompany', ['company' => $company, 'companies' => $companies ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usersNatu = User::where('kind_person', false)->get();
        return inertia('Company/Processes/CreateCompanies', ['usersNatu' => $usersNatu]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $companyData = $request->validated();

        $company = Company::create($companyData);
        $user = User::find($request->usersN);
        $user->companies()->attach($company->id);
        $user->update(['kind_person' => true]);


        return redirect()->route('companies.index')->with('success', 'Se creó exitosamente la compañía. Sigue el proceso, sube los documentos de la compañía.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
