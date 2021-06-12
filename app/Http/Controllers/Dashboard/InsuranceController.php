<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Insurances\InsuranceRepositoryInterface;

class InsuranceController extends Controller
{
    private $insurance;

    public function __construct(InsuranceRepositoryInterface $insurance)
    {
        $this->insurance = $insurance;
    }

    public function index()
    {
        return $this->insurance->index();
    }

    public function create()
    {
        return $this->insurance->create();
    }


    public function store(Request $request)
    {
        return $this->insurance->store($request);
    }

    public function edit($id)
    {
        return $this->insurance->edit($id);
    }


    public function update(Request $request)
    {
        return $this->insurance->update($request);
    }



    public function destroy(Request $request)
    {
        return $this->insurance->destroy($request);
    }

}
