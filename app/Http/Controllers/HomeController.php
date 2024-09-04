<?php

namespace App\Http\Controllers;

use Atyalpa\Http\RequestHandler;
use Atyalpa\Http\ResponseHandler;

class HomeController
{
    public function index(RequestHandler $requestHandler): ResponseHandler
    {
        return (new ResponseHandler())->json([
            'data' => 'sample-data',
        ]);
    }
}
