<?php

namespace SujanSht\AdminMaster\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use SujanSht\AdminMaster\Http\Controllers\Controller;

class DashboardController extends Controller
{


    public function dashboard()
    {
        if (View::exists('admin.dashboard.index')) {
            return view('admin.dashboard.index');
        } else {
            return view('admin-master::admin.dashboard.index');
        }
    }

}
