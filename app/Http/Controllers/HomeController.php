<?php

namespace App\Http\Controllers;

use App\Models\User;

class HomeController
{
    public function index()
    {
        $users = User::all();

        return $users->toArray();
    }
}
