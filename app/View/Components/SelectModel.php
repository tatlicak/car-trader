<?php

namespace App\View\Components;

use Closure;
use App\Models\Model;
use Illuminate\View\Component;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;

class SelectModel extends Component
{
    public Collection $models;
    
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->models = Model::orderBy('name')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-model');
    }
}
