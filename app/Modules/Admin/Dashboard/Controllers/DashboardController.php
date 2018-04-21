<?php

namespace App\Modules\Admin\Dashboard\Controllers;


use App\Http\Controllers\Admin\AdminBaseController;

class DashboardController extends AdminBaseController
{
    public function index()
    {
        return view('AdminDashboard::index');
    }
}
