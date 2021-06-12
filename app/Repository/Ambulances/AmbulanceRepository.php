<?php

namespace App\Repository\Ambulances;

use App\Interfaces\Ambulances\AmbulanceRepositoryInterface;
use App\Models\Ambulance;



class AmbulanceRepository implements AmbulanceRepositoryInterface
{
    public function index()
    {
        $ambulances = Ambulance::all();
        return view('Dashboard.ambulances.index', compact('ambulances'));
    }

    public function create()
    {
        return view('Dashboard.ambulances.create');
    }

    public function store($request)
    {
        //return $request->all();
        try {
            $requestData=$request->except(['_token','_method']);
            Ambulance::create($requestData);
            session()->flash('add');
            return redirect()->route('ambulances.create');
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $ambulance = Ambulance::findorfail($id);
        return view('Dashboard.ambulances.edit', compact('ambulance'));
    }

    public function update($request)
    {
       // return $request->all();
        if (!$request->has('is_available'))
            $request->request->add(['is_available' => 2]);
        else
            $request->request->add(['is_available' => 1]);
        $requestData=$request->except(['_token','_method','id']);

        $ambulance = Ambulance::findOrFail($request->id);
        $ambulance->update($requestData);
        session()->flash('edit');
        return redirect('ambulances');
    }

    public function destroy($request)
    {
        // return $request->all();
        Ambulance::destroy($request->id);
        session()->flash('delete');
        return redirect('ambulances');
    }
}
