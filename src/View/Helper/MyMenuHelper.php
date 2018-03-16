<?php 
namespace App\View\Helper;
use Cake\View\Helper;

class MyMenuHelper extends Helper
{
    public $helpers = ['Url'];

    public function mainActive($link)
    {
        $url = $this->Url->build($link);
        $here = $this->request->here;

		return $url === $here ? 'active' : 'inactive';
    }

    public function dashboardActive($controller)
    {
        $activeController = $this->request->getParam('controller');
        
        return $activeController == $controller ? 'active' : 'inactive';
    }

}
