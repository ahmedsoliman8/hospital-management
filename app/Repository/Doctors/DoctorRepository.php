<?php

namespace App\Repository\Doctors;

use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Section;
use Illuminate\Support\Facades\DB;
use  App\Traits\UploadTrait;
use Illuminate\Support\Facades\Hash;

class DoctorRepository implements DoctorRepositoryInterface
{
    use UploadTrait;

    public function index()
    {
        $doctors = Doctor::all();
       // return $doctors[0]->section;
        //dd( $doctors);
        $appointments=Appointment::all();
        return view('Dashboard.doctors.index',compact('doctors','appointments'));
    }


    public function create()
    {
        $sections = Section::all();
        $appointments=Appointment::all();
        return view('Dashboard.doctors.add',compact('sections','appointments'));
    }

    public function store($request){
     //   return $request->all();
        try {
            DB::beginTransaction();
            $requestData=$request->except(['_token','_method','photo']);
            $requestData["password"] = Hash::make($request->password);
            $requestData["appointments"] =implode(",",$request->appointments);
            $doctor=Doctor::create($requestData);
           //Upload img
            $this->verifyAndStoreImage($request,'photo','doctors','upload_image',$doctor->id,'App\Models\Doctor');
            DB::commit();
            session()->flash('add');
            return redirect()->route('doctors.create');

        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    public function update($request)
    {
        // TODO: Implement update() method.
    }

    public function destroy($request)
    {
       // return $request->all();
        if($request->item){
            foreach ($request->item as $item){
                $doctor=Doctor::find($item);
                if($doctor&&$doctor->image){
                    $this->Delete_attachment('upload_image','doctors/'.$doctor->image->filename,$item,$doctor->image->filename);
                }
            }
            Doctor::destroy($request->item);
            session()->flash('delete');
            return redirect()->route('doctors.index');

        }
        //---------------------------------------------------------------
        else{
            if($request->filename){
                $this->Delete_attachment('upload_image','doctors/'.$request->filename,$request->id,$request->filename);
            }
            Doctor::destroy($request->id);
            session()->flash('delete');
            return redirect()->route('doctors.index');
        }
    }
}
