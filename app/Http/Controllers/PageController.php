<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page.index');
    }
}
