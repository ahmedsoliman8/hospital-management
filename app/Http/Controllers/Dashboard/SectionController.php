<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Sections\SectionRepositoryInterface;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    private $sections;
    public function __construct(SectionRepositoryInterface    $sections )
    {
         $this->sections=$sections;
    }
    public function index()
    {
        return $this->sections->index();
    }
    public function show($id)
    {
        return $this->sections->show($id);
    }
    public function store(Request $request)
    {
        return $this->sections->store($request);
    }
    public function update(Request $request)
    {
        return $this->sections->update($request);
    }
    public function destroy(Request $request)
    {
        return $this->sections->destroy($request);
    }
}
