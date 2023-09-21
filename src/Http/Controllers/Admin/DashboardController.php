<?php

namespace SujanSht\LaraAdmin\Http\Controllers\admin;

use SujanSht\LaraAdmin\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard.index');
    }
}
