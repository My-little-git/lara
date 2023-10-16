<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Services\Posts\Service;

class BaseController extends Controller
{
    public Service $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
