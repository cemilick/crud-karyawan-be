<?php

namespace App\Http\Controllers\Api;

use App\Models\Job;
use Illuminate\Http\Request;


class JobController extends BaseCrudController
{
    protected $class = Job::class;

    public function index(Request $request)
    {
        $data = Job::all();

        return $this->sendResponse($data, 'Data return successfully.');
    }
}
