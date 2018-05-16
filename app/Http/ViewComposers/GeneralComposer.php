<?php

namespace App\Http\ViewComposers;

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
        $auth = auth()->user();

        $view->with('auth', $auth);
    }
}