<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /**
     * Show home page.
     *
     * @return \Inertia\Response
     */
    public function home()
    {
        if (auth()->check()) {

            $wishes = auth()->user()->wishes
                        ->where('status', 'in_progress')
                            ->groupBy('type');

            return inertia('Home', [
                'wishes' => $wishes,
            ]);
        }

        return inertia('Welcome');
    }
}
