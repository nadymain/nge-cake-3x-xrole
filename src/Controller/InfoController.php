<?php
namespace App\Controller;

use App\Controller\AppController;

class InfoController extends AppController
{
    /**
     * initialize
     */
    public function initialize()
    {
        parent::initialize();
        
        $this->Auth->allow(['show']);
    }

    /**
     * show
     */
    public function show($slug)
    {
        $this->loadModel('Infos');
        $info = $this->Infos
            ->findBySlug($slug)
            ->where([
                    'Infos.status' => 1,
                ])
            ->firstOrFail();
        $this->set(compact('info'));
    }
}
