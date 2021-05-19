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
        return view('Dashboard.doctors.index',compact('doctors'));
    }


    public function create()
    {
        $sections = Section::all();
        $appointments=Appointment::all();
        return view('Dashboard.doctors.add',compact('sections','appointments'));
    }

    public function store($request){

        try {
            DB::beginTransaction();
            $requestData=$request->except(['_token','_method','photo','appointments']);
            $requestData["password"] = Hash::make($request->password);
            $doctor=Doctor::create($requestData);
            $doctor->doctorappointments()->attach($request->appointments);
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

    public function edit($id)
    {
        $doctor=Doctor::find($id);
        $sections = Section::all();
        $appointments=Appointment::all();
        $appointmentSelected=$doctor->doctorappointments->pluck("id")->toArray();
        return view('Dashboard.doctors.edit',compact('sections','appointments','doctor','appointmentSelected'));
    }

    public function update($request)
    {

       // dd( $request->all());
        try {
            DB::beginTransaction();
            $doctor=Doctor::find($request->id);
            $requestData=$request->except(['_token','_method','photo','appointments']);
            $doctor->update($requestData);
            // update pivot tABLE
            $doctor->doctorappointments()->sync($request->appointments);

            // update photo
            if ($request->has('photo')){
                // Delete old photo
              //  return $doctor->image;
                if ($doctor->image){
                    $old_img = $doctor->image->filename;
                    $this->Delete_attachment('upload_image','doctors/'.$old_img,$request->id,$old_img);
                }
                //Upload img
                $this->verifyAndStoreImage($request,'photo','doctors','upload_image',$request->id,'App\Models\Doctor');
            }

            DB::commit();
            session()->flash('edit');
            return redirect()->back();
        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        if($request->item){
            foreach ($request->item as $item){
                $doctor=Doctor::find($item);
                if($doctor&&$doctor->image){
                    $this->Delete_attachment('upload_image','doctors/'.$doctor->image->filename,$item,$doctor->image->filename);
                }
            }
            Doctor::destroy($request->item);


        }
        else{
            if($request->filename){
                $this->Delete_attachment('upload_image','doctors/'.$request->filename,$request->id,$request->filename);
            }
            Doctor::destroy($request->id);

        }
        session()->flash('delete');
        return redirect()->route('doctors.index');
    }

    public function update_password($request)
    {
        try {
            $doctor = Doctor::findorfail($request->id);
            $doctor->update([
                'password'=>Hash::make($request->password)
            ]);

            session()->flash('edit');
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update_status($request)
    {
        try {
            $doctor = Doctor::findorfail($request->id);
            $doctor->update([
                'status'=>$request->status
            ]);

            session()->flash('edit');
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
