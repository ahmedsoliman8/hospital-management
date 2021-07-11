<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Patients\PatientRepositoryInterface;

class PatientController extends Controller
{
    private $patient;

    public function __construct(PatientRepositoryInterface $patient)
    {
        $this->patient = $patient;
    }

    public function index()
    {
        return  $this->patient->index();
    }

    public function create()
    {
        return  $this->patient->create();
    }


    public function store(Request $request)
    {
        return  $this->patient->store($request);
    }

    public function edit($id)
    {
        return  $this->patient->edit($id);
    }

    public function show($id)
    {
        return  $this->patient->show($id);
    }


    public function update(Request $request)
    {
        return  $this->patient->update($request);
    }



    public function destroy(Request $request)
    {
        return  $this->patient->destroy($request);
    }

}
