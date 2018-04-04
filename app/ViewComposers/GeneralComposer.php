<?php

namespace App\ViewComposers;

use Illuminate\View\View;

class GeneralComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $authUser = auth()->user();

        $view->with('auth_user', $authUser);
    }
}