<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trandesc;
use App\Models\Docdesc;
use App\Models\Status;
use App\Models\ReleasedDoc;
use App\Models\ProcedureSection;

class UtilityController extends Controller
{
    public function index()
    {
        $trandesc = Trandesc::join('procedure_sections', 'trandesc.section_id', '=', 'procedure_sections.id')
                            ->select('trandesc.*', 'procedure_sections.section_desc')
                            ->get();

        $docdesc = Docdesc::all();
        $section = ProcedureSection::all();
        $status = Status::all();
        $release = ReleasedDoc::all();

        return view('utility/utilities')
                ->with('docdesc', $docdesc)
                ->with('status', $status)
                ->with('section', $section)
                ->with('release', $release)
                ->with('trandesc', $trandesc);
    }


    // public function trandescform(){
    //     $section = Section::all();

    //     return view('utility.trandescform')
    //     ->with('section', $section);
    // }

    public function store_trandesc(Request $request){
        $trandesc = new Trandesc;
        if($request->file('file')){
            $file = $request->file('file');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $request->file->move('storage/', $filename);

            $trandesc->file = $filename;
        }

        $trandesc->tran_desc = $request->tran_desc;
        $trandesc->section_id = $request->section_id;
        
        $trandesc->save();
    
        return redirect()->back();
    }

    public function store_docdesc(Request $request){
        $docdesc = new Docdesc;

        $docdesc->doc_desc = $request->doc_desc;
        
        $docdesc->save();
    
        return redirect()->back();
    }

    public function store_statusdesc(Request $request){
        $statusdesc = new Status;

        $statusdesc->status_name = $request->status_desc;
        
        $statusdesc->save();
    
        return redirect()->back();
    }

    public function store_permitTemp(Request $request){
        $permit = new ReleasedDoc;
        if($request->file('file')){
            $file = $request->file('file');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $request->file->move('storage/', $filename);

            $permit->file = $filename;
        }
        $permit->doc_desc = $request->doc_desc;
        
        $permit->save();
    
        return redirect()->back();
    }

    public function edit_trandesc(Request $request)
    {
      
        Trandesc::where('id', '=', $request->input('tran_id'))->update(array(
            'tran_desc' => $request->input('tran_desc'),
            'section_id' => $request->input('section'),
            ));

        return redirect('/utilities');
    }

    public function edit_docdesc(Request $request)
    {
      
        Docdesc::where('id', '=', $request->input('doc_id'))->update(array(
            'doc_desc' => $request->input('doc_desc'),
            ));

        return redirect()->back();
    }

    public function edit_statusdesc(Request $request)
    {
      
        Status::where('id', '=', $request->input('status_id'))->update(array(
            'status_name' => $request->input('status_desc'),
            ));

        return redirect()->back();
    }

    public function edit_permitTemp(Request $request)
    {
        $permit_id = $request->input('permit_id');
        $doc_desc = $request->input('doc_desc');
        $permit = ReleasedDoc::find($permit_id);
        if($request->file('file')){
            $file = $request->file('file');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $request->file->move('storage/', $filename);

            $permit->file = $filename;
        }

        $permit->doc_desc = $doc_desc;
        $permit->save();

        return redirect()->back();
    }

    public function delete_trandesc($id)
    {
        Trandesc::where('id', '=', $id)->delete();
  
        return  redirect()->back()->with('alert', 'tran_desc Deleted');
    
    }

    public function delete_docdesc($id)
    {
        Docdesc::where('id', '=', $id)->delete();
  
        return  redirect()->back()->with('alert', 'tran_desc Deleted');
    
    }

    public function delete_statusdesc($id)
    {
        Status::where('id', '=', $id)->delete();
  
        return  redirect()->back()->with('alert', 'tran_desc Deleted');
    
    }

    public function delete_permitDoc($id)
    {
        ReleasedDoc::where('id', '=', $id)->delete();
  
        return  redirect()->back()->with('alert', 'Permit Template Deleted!');
    
    }

}
