<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

class MySettingComponent extends Component
{
    public function initialize(array $config)
    {
        $table = TableRegistry::get('Settings');
        $settings = $table
            ->find()
            ->select(['input_key', 'input_value']);

        foreach($settings as $setting) {
            Configure::write($setting->input_key, $setting->input_value);
        }
    }
}