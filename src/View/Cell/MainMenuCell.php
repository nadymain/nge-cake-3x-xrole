<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * MainMenu cell
 */
class MainMenuCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
        $this->loadModel('Menus');
        
        $mainmenu = $this->Menus
            ->find('threaded')
            ->order(['Menus.lft' => 'ASC']);

        $this->set(compact('mainmenu'));
    }
}
