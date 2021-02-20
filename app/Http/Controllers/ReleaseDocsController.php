<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docdesc;
use App\Models\ReleasedDoc;
use App\Models\Status;
use App\Models\RequestRelDoc;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\RequestDoc;
use App\Notifications\ApproveReq;
use Auth;

class ReleaseDocsController extends Controller
{
    public function index()
    {
        $docdesc = Docdesc::all();
        $reldoc = ReleasedDoc::all();
        $status = Status::all();
        $transaction = Transaction::all();

        $documentPending = RequestRelDoc::join('status', 'status.id', '=', 'request_rel_docs.status_id')
                                ->join('users', 'users.id', '=', 'request_rel_docs.requser_id')
                                ->join('released_docs', 'released_docs.id', '=', 'request_rel_docs.reldoc_id')
                                ->select('request_rel_docs.*', 'released_docs.doc_desc', 'status.status_name', 'users.name')
                                ->where('request_rel_docs.status_id','!=', 2)
                                ->paginate(10);

        $documentApproved = RequestRelDoc::join('status', 'status.id', '=', 'request_rel_docs.status_id')
                                ->join('users', 'users.id', '=', 'request_rel_docs.requser_id')
                                ->join('released_docs', 'released_docs.id', '=', 'request_rel_docs.reldoc_id')
                                ->select('request_rel_docs.*', 'released_docs.doc_desc', 'status.status_name', 'users.name')
                                ->where('request_rel_docs.status_id','=', 2)
                                ->paginate(10);

        $document = Transaction::orderBy('transactions.id', 'DESC')
                                ->join('trandesc', 'trandesc.id','=', 'transactions.procedure_id')
                                ->join('procedure_sections', 'procedure_sections.id','=', 'trandesc.section_id')
                                ->join('applicants', 'applicants.id','=', 'transactions.applicant_id')
                                ->join('status', 'status.id','=', 'transactions.status_ID')
                                ->select('transactions.*', 'applicants.fname', 'applicants.lname', 'status.status_name')
                                ->where('transactions.status_ID', '=', 2)
                                ->paginate(10);
        
        return view('documents/releaseDocs')
                ->with('docdesc', $docdesc)
                ->with('reldoc', $reldoc)
                ->with('status', $status)
                ->with('transaction', $transaction)
                ->with('documentApproved', $documentApproved)
                ->with('documentPending', $documentPending)
                ->with('document', $document);
    }


    public function store_release(Request $request)
    {
        $documents = new RequestRelDoc;
        $status = Status::all();

        $documents->reldoc_id = $request->reldoc_id;
        $documents->tran_id = $request->tran_id;
        $documents->remarks = $request->remarks;
        $documents->status_id = 1;
        $documents->requser_id = Auth::user()->id;
        $documents->save();
        $user = User::where('is_admin', '=', 1)->first();
        $user->notify(new RequestDoc());

        return redirect('/releaseDocs')->with('status','Document added');
    }

    public function store_template(Request $request)
    {
        $documents = new ReleasedDoc;
        $reldoc = ReleasedDoc::all();

        $documents->doc_desc = $request->doc_desc;
        $documents->file = $request->file;
        
        $documents->save();

        return redirect('/releaseDocs')->with('reldoc','Document added');
    }

    public function show($id)
    {
        $document = RequestRelDoc::join('released_docs', 'released_docs.id', 'request_rel_docs.reldoc_id')
                                ->join('status', 'status.id', 'request_rel_docs.status_id')
                                ->join('users', 'users.id', 'request_rel_docs.requser_id')
                                ->select('request_rel_docs.*', 'released_docs.doc_desc', 'released_docs.file', 'status.status_name', 'users.name')
                                ->where('request_rel_docs.id', '=', $id)
                                ->first();

        $reldoc = ReleasedDoc::all();

        return view('documents/showReq')
        ->with('document', $document)
        ->with('reldoc', $reldoc);
    }

    public function edit_reldoc($id)
    {
        $document = ReleasedDoc::findOrFail($id);
        
        
        return view('documents/edit_relDocs')
        ->with('document', $document);
    }

    public function update_relDoc(Request $request)
    {
        RequestRelDoc::where('id', '=', $request->input('req_id'))->update(array(
            'reldoc_id' => $request->input('reldoc_id'),
            'tran_id' => $request->input('tran_id'),
            'remarks' => $request->input('remarks'),
            ));
            
            return redirect('/releaseDocs')->with('status','Document Updated');
        
    }

    public function update_status(Request $request, $id)
    {
        RequestRelDoc::where('id', '=', $id)
                    ->update(['status_id' => 2]);
        $user_id = RequestRelDoc::where('id', '=', $id)->select('request_rel_docs.requser_id')->first();
        $user = User::where('id', '=', $user_id->requser_id)->first();
        $doc = RequestRelDoc::all()->where('id', '=', $id);
        $user->notify(new ApproveReq($doc));
        return redirect('/releaseDocs')->with('status','Document Updated');
        
    }


    
}
