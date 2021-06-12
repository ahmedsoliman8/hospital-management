<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 4/13/2021
 * Time: 2:15 PM
 */

namespace App\Interfaces\Ambulances;



interface AmbulanceRepositoryInterface
{
    // get All Ambulances
    public function index();

    // create Ambulances
    public function create();

    // store Ambulances
    public function store($request);

    // Update Ambulances
    public function update($request);

    // destroy Ambulances
    public function destroy($request);

}