<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 4/13/2021
 * Time: 2:15 PM
 */

namespace App\Interfaces\Patients;



interface PatientRepositoryInterface
{
    public function create();
    // get All Patients
    public function index();

    // store Patients
    public function store($request);

    // Update Patients
    public function update($request);

    // destroy Patients
    public function destroy($request);

    // destroy Patients
    public function show($id);

}