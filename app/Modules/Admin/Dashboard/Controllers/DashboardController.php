<?php

namespace App\Modules\Admin\Dashboard\Controllers;


use App\Http\Controllers\Admin\AdminBaseController;

class DashboardController extends AdminBaseController
{
    public function index()
    {
        $this->authorize('admin.dashboard.index');

        return view('admin.dashboard.index');
    }
}
