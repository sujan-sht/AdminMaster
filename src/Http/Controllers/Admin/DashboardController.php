<?php

namespace SujanSht\AdminMaster\Http\Controllers\Admin;

use View;
use Illuminate\Http\Request;
use SujanSht\AdminMaster\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if(View::exists('admin.dashboard.index')){
            return view('admin.dashboard.index');
        }else{
            return view('admin-master::admin.dashboard.index');
        }
    }
}
