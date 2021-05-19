<?php

namespace App\Repository\Services\SingleServices;

use App\Interfaces\Services\SingleServices\SingleServiceRepositoryInterface;
use App\Models\Service;

class SingleSeviceRepository implements SingleServiceRepositoryInterface
{

    public function index()
    {
        $singleServices = Service::all();
        //dd( $sections);
        return view('Dashboard.services.single_service.index',compact('singleServices'));
    }

    public function store($request)
    {

      //  return $request->all();

        $requestData=$request->except(['_token','_method']);
        // return $request->input() ;
        Service::create($requestData);
        session()->flash('add');
        return redirect()->route('service.index');
    }

    public function update($request)
    {

        $requestData=$request->except(['_token','_method','id']);
        $service = Service::findOrFail($request->id);
        //return $section;
        // return($requestData);
        $service->update($requestData);
        session()->flash('edit');
        return redirect()->route('service.index');
    }


    public function destroy($request)
    {
        Service::findOrFail($request->id)->delete();
        session()->flash('delete');
        return redirect()->route('service.index');
    }



}
