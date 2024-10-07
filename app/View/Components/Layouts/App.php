<?php

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class App extends Component
{
    /**
     * Create a new component instance.
     */

    public string $userName;

    public function __construct()
    {
        $this->userName = Auth::check() ? Auth::user()->name : 'Guest';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.app', [
            'userName' => $this->userName,
        ]);
    }
}
