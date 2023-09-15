<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if(auth()->user()->roles != 'admin') {
            abort(403);
        }

        return view('pages.dashboard.index');
    }
}