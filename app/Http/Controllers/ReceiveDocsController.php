<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReceivedDoc;
use App\Models\Docdesc;
use App\Models\DocStatus;
use App\Models\Department;
use App\Models\ReleasedDoc;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\SendDoc;
use App\Notifications\RecDoc;
use Auth;
use DB;


class ReceiveDocsController extends Controller
{
    public function index()
    {
        $user = Auth::user()->dept_id;
        if(Auth::user()->is_admin == 1){
            $document = ReceivedDoc::join('docstatus', 'docstatus.id', '=', 'received_docs.status')
                                ->join('users', 'users.id', '=', 'received_docs.user_id')
                                ->join('docdesc', 'docdesc.id', '=', 'received_docs.doc_id')
                                ->select('received_docs.*', 'docdesc.doc_desc', 'docstatus.status_desc', 'users.dept_id')
                                ->where('received_docs.dept_id', '=', 9)
                                ->where('docstatus.id', '!=', 10)
                                ->paginate(10);

            $documentOnhand = ReceivedDoc::join('docstatus', 'docstatus.id', '=', 'received_docs.status')
                                ->join('users', 'users.id', '=', 'received_docs.user_id')
                                ->join('docdesc', 'docdesc.id', '=', 'received_docs.doc_id')
                                ->where('received_docs.dept_id', '=', 9)
                                ->where('docstatus.id', '=', 10)
                                ->select('received_docs.*', 'docdesc.doc_desc', 'docstatus.status_desc', 'users.dept_id')
                                ->paginate(10);

            $department = Department::all();
            $reldoc = ReleasedDoc::all();                 
            $docdesc = Docdesc::all();
            return view('documents/receiveDocs')
                    ->with('document', $document)
                    ->with('documentOnhand', $documentOnhand)
                    ->with('department', $department)
                    ->with('docdesc', $docdesc)
                    ->with('reldoc', $reldoc);
        }else{
            $document = ReceivedDoc::join('docstatus', 'docstatus.id', '=', 'received_docs.status')
                                ->join('users', 'users.id', '=', 'received_docs.user_id')
                                ->join('docdesc', 'docdesc.id', '=', 'received_docs.doc_id')
                                ->select('received_docs.*', 'docdesc.doc_desc', 'docstatus.status_desc', 'users.dept_id')
                                ->where('received_docs.dept_id', '=', $user)
                                ->where('docstatus.id', '!=', $user + 1)
                                ->paginate(10);

            $documentOnhand = ReceivedDoc::join('docstatus', 'docstatus.id', '=', 'received_docs.status')
                                ->join('users', 'users.id', '=', 'received_docs.user_id')
                                ->join('docdesc', 'docdesc.id', '=', 'received_docs.doc_id')
                                ->select('received_docs.*', 'docdesc.doc_desc', 'docstatus.status_desc', 'users.dept_id')
                                ->where('received_docs.dept_id', '=', $user)
                                ->where('docstatus.id', '=', $user + 1)
                                ->paginate(10);

            $department = Department::all();
            $reldoc = ReleasedDoc::all();                 
            $docdesc = Docdesc::all();
            return view('documents/receiveDocs')
                    ->with('document', $document)
                    ->with('department', $department)
                    ->with('documentOnhand', $documentOnhand)
                    ->with('docdesc', $docdesc)
                    ->with('reldoc', $reldoc);
        }
        
           
    }

    public function store_receive(Request $request)
    {
        $documents = new ReceivedDoc;
        if($request->file('file')){
            $file = $request->file('file');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $request->file->move('storage/', $filename);

            $documents->file = $filename;
        }

        $documents->doc_id = $request->doc_id;
        $documents->tran_id = $request->tran_id;
        $documents->status = 1;
        $documents->dept_id = 1;
        $documents->user_id = Auth::user()->id;
        $documents->remarks = $request->remarks;
        $documents->sender  = auth()->user()->id;
        $documents->save();
        
        $status = DocStatus::all();
        return redirect()->back();
    }



    public function show($id)
    {
        $document = ReceivedDoc::join('docdesc', 'docdesc.id', 'received_docs.doc_id')
                                ->join('docstatus', 'docstatus.id', 'received_docs.status')
                                ->join('users', 'users.id', 'received_docs.user_id')
                                ->select('received_docs.*', 'docdesc.doc_desc', 'docstatus.status_desc', 'users.name')
                                ->where('received_docs.id', '=', $id)
                                ->first();

        $docdesc = Docdesc::all();
        $department = Department::all();

        return view('documents/show_receiveDocs')
        ->with('document', $document)
        ->with('department', $department)
        ->with('docdesc', $docdesc);
    }

    public function edit($id)
    {
        $document = ReceivedDoc::findOrFail($id);
        $docdesc = Docdesc::all();
        
        
        return view('documents/edit_receiveDocs')
        ->with('document', $document)
        ->with('docdesc', $docdesc);
    }

    public function update(Request $request, $id)
    {
        $document = ReceivedDoc::find($id);
        if($request->file('file')){
            $file = $request->file('file');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $request->file->move('storage/', $filename);

            $document->file = $filename;
        }

        $document->doc_id = $request->input('doc_id');
        $document->tran_id = $request->input('tran_id');
        $document->remarks = $request->input('remarks');
        $document->save();
            
            return redirect('/receiveDocs')->with('status','Document Updated');
        
    }

    public function update_status(Request $request, $id)
    {
        
        if(Auth::user()->dept_id==1){
            ReceivedDoc::where('id', '=', $id)
                    ->update(['status' => 2]);
        }
        elseif(Auth::user()->dept_id==2){
            ReceivedDoc::where('id', '=', $id)
                    ->update(['status' => 3]);
        }
        elseif(Auth::user()->dept_id==3){
            ReceivedDoc::where('id', '=', $id)
                    ->update(['status' => 4]);
        }
        elseif(Auth::user()->dept_id==4){
            ReceivedDoc::where('id', '=', $id)
                    ->update(['status' => 5]);
        }
        elseif(Auth::user()->dept_id==5){
            ReceivedDoc::where('id', '=', $id)
                    ->update(['status' => 6]);
        }
        elseif(Auth::user()->dept_id==6){
            ReceivedDoc::where('id', '=', $id)
                    ->update(['status' => 7]);
        }
        elseif(Auth::user()->dept_id==7){
            ReceivedDoc::where('id', '=', $id)
                    ->update(['status' => 8]);
        }
        elseif(Auth::user()->dept_id==8){
            ReceivedDoc::where('id', '=', $id)
                    ->update(['status' => 9]);
        }
        elseif(Auth::user()->dept_id==9){
            ReceivedDoc::where('id', '=', $id)
                    ->update(['status' => 10]);
        }

       
        $users = User::where('id', '=', $request->input('user_id'))->first();
        
        if($users->id != auth()->user()->id){
            $users->notify(new RecDoc());
        }
        

        
       return redirect('/receiveDocs')->with('status','Document Updated');
        
        
    }

    public function update_dept(Request $request, $id)
    {
        
        ReceivedDoc::where('id', '=', $id)
        ->update([
            'dept_id' => $request->input('dept_id'),
            'sender'  => auth()->user()->id
            ]);
        $doc = ReceivedDoc::where('id', '=', $id)->select('received_doc.created_at');
        $users = User::all()->where('dept_id', '=', $request->input('dept_id'));
        foreach($users as $user){

        $user->notify(new SendDoc($doc));

        return redirect('/receiveDocs')->with('status','Document Updated');

        }
        

        
        
        
    }

    public function show_subDocs($id)
    {
        $document = ReceivedDoc::join('docdesc', 'docdesc.id', 'received_docs.doc_id')
                            ->join('docstatus', 'docstatus.id', 'received_docs.status')
                            ->select('received_docs.*', 'docdesc.doc_desc', 'docstatus.status_desc')
                            ->where('tran_id', $id)->get();

        $docdesc = Docdesc::all(); 
        $doctran = Transaction::join('status', 'status.id', '=', 'transactions.status_ID')
                    ->select('transactions.*', 'status.status_name')
                    ->where('transactions.id', $id)
                    ->first();

        $tranid = Transaction::all();
                    

        return view('documents/documents', compact('document'))
                                    ->with('docdesc', $docdesc)
                                    ->with('doctran', $doctran)
                                    ->with('tranid', $tranid);
    }
}
