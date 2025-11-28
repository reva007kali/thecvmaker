<?php

namespace App\Livewire;

use Livewire\Component;

class Sidebar extends Component
{
    public $isSidebarOpen = true;
    public $activeMenu = 'dashboard';
    public $openSubmenu = null;

    public function toggleSidebar()
    {
        $this->isSidebarOpen = !$this->isSidebarOpen;
    }

    public function setActiveMenu($menu)
    {
        $this->activeMenu = $menu;
    }

    public function toggleSubmenu($menu)
    {
        $this->openSubmenu = $this->openSubmenu === $menu ? null : $menu;
    }
    public function render()
    {

        return view('livewire.sidebar');
    }
}
