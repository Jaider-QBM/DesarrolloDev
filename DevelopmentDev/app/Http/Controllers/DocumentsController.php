<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Documents;
use App\Models\User;


class DocumentsController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $companyId = $request->query('companyId');
        $userId = $request->query('userId');
        $companies = Company::find($companyId);
        $users = User::find($userId);
        $document = Documents::where('company_id', $companyId)->get();

        return inertia('Documents/CreateDocuments', ['companies' => $companies, 'users' => $users,  'documents' => $document ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */

    public function store(Request $request)
    {
        $request->validate([
            'document_type' => 'required',
            'url_document' => 'required|file|mimes:pdf|max:2048',
            'review_status' => 'required',
        ]);

        $path = $request->file('url_document')->store('documents');

        $document = new Documents();
        $document->company_id = $request->company_id;
        $document->document_type = $request->document_type;
        $document->url_document = $path;
        $document->review_status = $request->review_status;
        $document->save();

        return redirect()->route('companies.index')->with('success', 'Se Subio Exitosamente los documentos de la compañia');
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
