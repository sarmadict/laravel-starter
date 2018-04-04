<?php

namespace App\Http\Controllers\Panel\Admin\Dashboard;


use App\Http\Controllers\Panel\Admin\AdminBaseController;

class DashboardController extends AdminBaseController
{
    public function index()
    {
        return view('panel.admin.dashboard.index');
    }
}
