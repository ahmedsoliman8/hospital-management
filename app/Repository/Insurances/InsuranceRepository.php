<?php

namespace App\Repository\Insurances;

use App\Interfaces\Insurances\InsuranceRepositoryInterface;
use App\Models\Insurance;


class InsuranceRepository implements InsuranceRepositoryInterface
{
    public function index()
    {
        $insurances = Insurance::all();
        return view('Dashboard.insurances.index', compact('insurances'));
    }

    public function create()
    {
        return view('Dashboard.insurances.create');
    }

    public function store($request)
    {
      //  return $request->all();
        try {

            $requestData=$request->except(['_token','_method']);
            // return $request->input() ;
            Insurance::create($requestData);
            session()->flash('add');
            return redirect()->route('insurances.create');
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $insurance = Insurance::findorfail($id);
        return view('Dashboard.insurances.edit', compact('insurance'));
    }

    public function update($request)
    {
       // return $request->all();
        if (!$request->has('status'))
            $request->request->add(['status' => 0]);
        else
            $request->request->add(['status' => 1]);
        $requestData=$request->except(['_token','_method','id']);
        $insurance = Insurance::findOrFail($request->id);
        $insurance->update($requestData);
        session()->flash('edit');
        return redirect('insurances');
    }

    public function destroy($request)
    {
       /// return $request->all();
        Insurance::destroy($request->id);
        session()->flash('delete');
        return redirect('insurances');
    }
}
