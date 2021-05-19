<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Services\SingleServices\SingleServiceRepositoryInterface;
use Illuminate\Http\Request;

class SingleServiceController extends Controller
{    private $services;
    public function __construct(SingleServiceRepositoryInterface    $services )
    {
        $this->services=$services;
    }
    public function index()
    {
        return   $this->services->index();
    }

    public function store(Request $request)
    {
        return   $this->services->store($request);
    }
    public function update(Request $request)
    {
        return   $this->services->update($request);
    }
    public function destroy(Request $request)
    {
        return   $this->services->destroy($request);
    }
}
