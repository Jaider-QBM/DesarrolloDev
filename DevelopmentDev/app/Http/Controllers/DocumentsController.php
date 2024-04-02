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
        // Recuperar la compañía y el usuario basándote en los parámetros de la solicitud
        $companyId = $request->query('companyId');
        $userId = $request->query('userId');

        // Aquí puedes buscar la información de la compañía y del usuario en la base de datos
        // Por ejemplo:
        $companies = Company::find($companyId);
        $users = User::find($userId);


        // Retornar la vista con los datos preparados
        return inertia('Documents/CreateDocuments', ['companies' => $companies, 'users' => $users ]);
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
            'company_id' => $request->query('companyId'),
            'document_type' => 'required',
            'url_document' => 'required|mimes:pdf|max:2048', // Asegúrate de que el archivo sea un PDF y no exceda el tamaño máximo
        ]);

        if ($request->hasFile('url_document')) {
            $file = $request->file('url_document');
            $path = $file->store('documents', 'public'); // Guarda el archivo en el disco 'public' en la carpeta 'documents'

            // Aquí puedes guardar la información del archivo en la base de datos
            // Por ejemplo, creando un nuevo registro en la tabla 'documents'
            $document = new Documents;
            $document->document_type = $request->document_type;
            $document->url_document = $path; // Guarda la ruta del archivo
            $document->review_status = $request->review_status;
            $document->save();
        }

        return redirect()->route('documents.index'); // Redirige al usuario a la página de índice de documentos
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
