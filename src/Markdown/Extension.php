<?php
namespace App\Markdown;

use Cake\Routing\Router;
use Parsedown;

class Extension extends Parsedown
{
    protected function inlineImage($excerpt)
    {
        $this->baseImagePath = Router::url('/img/', true);

        $image = parent::inlineImage($excerpt);

        $image['element']['attributes']['src'] = $this->baseImagePath . $image['element']['attributes']['src'];

        return $image;
    }
}
