<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 4/13/2021
 * Time: 2:15 PM
 */

namespace App\Interfaces\Doctors;



interface DoctorRepositoryInterface
{
    // get All Sections
    public function index();

    // store Sections
    public function store($request);

    // Update Sections
    public function update($request);

    // destroy Sections
    public function destroy($request);

}