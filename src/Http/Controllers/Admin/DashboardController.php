<?php

namespace SujanSht\AdminMaster\Http\Controllers\Admin;

use SujanSht\AdminMaster\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('admin-master::admin.dashboard.index');
    }
}
