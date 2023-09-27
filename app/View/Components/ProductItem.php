<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductItem extends Component
{
    /**
     * Create a new component instance.
     */
    public $product_item =null;
    public function __construct($product)
    {
     $this->product_item= $product;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $product = $this->product_item;
        return view('components.product-item',compact('product'));
    }
}
