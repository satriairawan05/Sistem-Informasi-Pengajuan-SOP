<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Constructor for LoginController.
     */
    public function __construct(public $name = "Home")
    {
        //
    }

    /**
     * Display a listing for User of the resource of Home.
     */
    public function home()
    {
        return view('admin.home',[
            'name' => $this->name
        ]);
    }
}
