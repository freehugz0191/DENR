<?php

namespace App\Http\Controllers;

use App\Models\Docdesc;
use App\Models\ReceivedDoc;
use Illuminate\Http\Request;

use Auth;
use DB;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $document = ReceivedDoc::all()->where('tran_id', 6);
       
        return view('documents/document', compact('document'));
    }

    public function file_index()
    {
        $documentShow = DB::table('documents')
                ->join('users', 'users.ID', '=', 'documents.created_by')
                ->select('documents.*', 'users.name')
                ->get();

       
        return view('documents/document', compact('documentShow'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $document = new Docdesc;

        $document->doc_desc = $request->doc_desc;
        $document->save();
    
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show($tran_id)
    {
        
        $document = ReceivedDoc::all()->where('tran_id', $tran_id);

        return view('documents/documents', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }
}
