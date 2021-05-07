<?php

namespace App\Repository\sections;

use App\Interfaces\sections\SectionRepositoryInterface;
use App\Models\Section;

class SectionRepository implements SectionRepositoryInterface
{

    public function index()
    {
        $sections = Section::all();
        //dd( $sections);
        return view('Dashboard.sections.index',compact('sections'));
    }

    public function store($request)
    {

        $requestData=$request->except(['_token','_method']);
       // return $request->input() ;
        Section::create($requestData);
        session()->flash('add');
        return redirect()->route('sections.index');
    }

    public function update($request)
    {

        $requestData=$request->except(['_token','_method','id']);
        $section = Section::findOrFail($request->id);
        //return $section;
       // return($requestData);
        $section->update($requestData);
        session()->flash('edit');
        return redirect()->route('sections.index');
    }


    public function destroy($request)
    {
        Section::findOrFail($request->id)->delete();
        session()->flash('delete');
        return redirect()->route('sections.index');
    }

    public function show($id)
    {

        $doctors =Section::findOrFail($id)->doctors;
        $section = Section::findOrFail($id);

        return view('Dashboard.sections.show_doctors',compact('doctors','section'));
    }

}
