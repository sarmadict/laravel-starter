<?php

namespace App\Http\ViewComposers;

use App\Http\Menus\AdminPanelMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminPanelComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $auth = Auth::user();

        $menu = app(AdminPanelMenu::class);

        $view->with('auth', $auth);
        $view->with('sidebar_menu', $menu->get());
    }
}