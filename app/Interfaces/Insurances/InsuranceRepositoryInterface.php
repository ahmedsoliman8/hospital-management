<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 4/13/2021
 * Time: 2:15 PM
 */

namespace App\Interfaces\Insurances;



interface InsuranceRepositoryInterface
{
    public function create();
    // get All Insurances
    public function index();

    // store Insurances
    public function store($request);

    // Update Insurances
    public function update($request);

    // destroy Insurances
    public function destroy($request);

}