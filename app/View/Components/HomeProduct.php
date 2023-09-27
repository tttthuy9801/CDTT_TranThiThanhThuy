<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Product;
use App\Models\Category;

class HomeProduct extends Component
{
    /**
     * Create a new component instance.
     */
    public $rowcat = null;
    public function __construct($catitem)
    {
        $this->rowcat = $catitem;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $cat = $this->rowcat;
        $listcatid = array();
        array_push($listcatid, $cat->id);
        $args1 = [

            ['status', '=', '1'],
            ['parent_id', '=', $cat->id],

        ];
        $list_category1 = category::where($args1)->get();
        if (count($list_category1) > 0) {
            foreach ($list_category1 as $cat1) {
                array_push($listcatid, $cat1->id);
                $args2 = [

                    ['status', '=', '1'],
                    ['parent_id', '=', $cat1->id],

                ];
                $list_category2 = category::where($args2)->get();
                if (count($list_category2) > 0) {
                    foreach ($list_category2 as $cat2) {
                        array_push($listcatid, $cat2->id);
                    }
                }
            }
        }

        $list_product = product::where('status', '=', '1')
            ->whereIn('category_id', $listcatid)
            ->orderby('created_at', 'DESC')
            ->get();
        return view('components.home-product', compact('cat', 'list_product', 'list_category1'));
    }
}
