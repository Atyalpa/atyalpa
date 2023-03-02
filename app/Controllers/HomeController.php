<?php

namespace App\Controllers;

class HomeController
{
	# [Route('/home', name: 'home')]
	public function index()
	{
		return "Hello world from controller!!";
	}
}
