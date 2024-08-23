<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function INDEX()
    {
        return view('pages.dashboard.index');
    }
}
