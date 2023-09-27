<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Menu;

class MainMenuItem extends Component
{
    /**
     * Create a new component instance.
     */
    public $rowmenu = null;
    public function __construct($itemmenu)
    {
        $this->rowmenu = $itemmenu;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $menu1 = $this->rowmenu;
        $id1 = $menu1->id;

        $args = [
            ['position', '=', 'mainmenu'],
            ['status', '=', 1],
            [
                'parent_id', '=', $menu1->id
            ],
        ];
        $listmenu2 = Menu::Where($args)
            ->orderBy('sort_order', 'ASC')
            ->get();
        $submenu = false;
        if ($listmenu2 != null) {
            $submenu = true;
        }
        return view('components.main-menu-item', compact('listmenu2', 'menu1', 'submenu'));
    }
}
