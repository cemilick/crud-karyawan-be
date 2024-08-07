<?php

namespace App\Http\Controllers\Api;

use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends BaseCrudController
{
    protected $class = Division::class;

    public function index(Request $request)
    {
        $data = Division::all();

        return $this->sendResponse($data, 'Data return successfully.');
    }
}
