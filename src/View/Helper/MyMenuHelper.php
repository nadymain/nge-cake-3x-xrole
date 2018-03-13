<?php 
namespace App\View\Helper;
use Cake\View\Helper;

class MyMenuHelper extends Helper
{
    public function active($controller)
    {
        $activeController = $this->request->getParam('controller');
        
        return $activeController == $controller ? 'active' : 'unactive';
    }
}
