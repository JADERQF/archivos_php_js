<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		echo view('header');
		return view('tables');
		echo view('footer');
	}
}
