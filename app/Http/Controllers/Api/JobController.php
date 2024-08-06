<?php

namespace App\Http\Controllers\Api;

use App\Models\Job;


class JobController extends BaseCrudController
{
    protected $class = Job::class;
}
