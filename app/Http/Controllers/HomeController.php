<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    // Use authentication for this thing
    public function __construct() {
        $this->middleware("auth");
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Warn the user that they aren't good enough, but give them the chance to withdraw their actions
     * @return \Illuminate\Http\Response
     */
    public function badAuth() {
        return view('auth.bad');
    }

}
