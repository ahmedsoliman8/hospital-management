<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 8/27/2021
 * Time: 3:00 PM
 */

namespace App\Interfaces\DoctorDashboard;


interface DiagnosisRepositoryInterface
{
    public function store($request);

    public function  addReview($request);

    public function show($id);

}