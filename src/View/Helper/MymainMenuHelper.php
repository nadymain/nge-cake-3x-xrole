<?php 
namespace App\View\Helper;
use Cake\View\Helper;

class MymainMenuHelper extends Helper
{
    public $helpers = ['Url'];

    public function active($link)
    {
        $url = $this->Url->build($link);
        $here = $this->request->here;

		return $url === $here ? 'active' : 'unactive';
    }
}
