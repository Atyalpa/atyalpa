<?php

namespace App\Http\Controllers;

use App\Models\User;
use Atyalpa\Handlers\RequestHandler;
use Atyalpa\Handlers\ResponseHandler;

class HomeController
{
    public function index(RequestHandler $requestHandler): ResponseHandler
    {
        //        $users = User::all();

        return (new ResponseHandler())->json([
            'data' => $requestHandler->getQueryParams()
        ]);
    }
}
