<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trandesc;

class GuideController extends Controller
{
    public function index(){
        $trandesc = Trandesc::join('procedure_sections', 'trandesc.section_id', '=', 'procedure_sections.id')
                            ->select('trandesc.*', 'procedure_sections.section_desc')
                            ->get();
        return view('guides/guides')
            ->with('trandesc', $trandesc);
    }

    public function edit_guide(Request $request, $id){
        
        $trandesc = Trandesc::find($id);
        
        $trandesc->guide = $request->input('guide');
        $trandesc->save();

        return redirect()->back();

    }

    public function show_guide($id){
        $trandesc = Trandesc::where('id', '=', $id)
                    ->first();
        return view('guides.guides_show')
                ->with('trandesc', $trandesc);
    }


}
