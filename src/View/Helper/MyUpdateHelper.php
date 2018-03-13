<?php

namespace App\View\Helper;
use Cake\View\Helper;

class MyUpdateHelper extends Helper
{
    public $helpers = ['Form'];

    public function status($status, $id)
    {
        $published = $this->Form->postLink(__('Published'), 
            ['action' => 'updateStatus', $id, $status], 
            ['class' => 'status published']
        );

        $draft = $this->Form->postLink(__('Draft'), 
            ['action' => 'updateStatus', $id, $status], 
            ['class' => 'status draft']
        );
        
        return $status == '1' ? $published : $draft;
    }
}
