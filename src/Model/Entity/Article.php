<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Collection\Collection;

/**
 * Article Entity
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string $description
 * @property string $image
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Tag[] $tags
 */
class Article extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'title' => true,
        'slug' => true,
        'content' => true,
        'description' => true,
        'image' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'tags' => true,
        'tag_string' => true,
    ];

    /**
     * _getTagString
     */
    protected function _getTagString()
    {
        if (isset($this->_properties['tag_string'])) {
            return $this->_properties['tag_string'];
        }

        if (empty($this->tags)) {
            return '';
        }

        $tags = new Collection($this->tags);
        $str = $tags->reduce(function ($string, $tag) {
            return $string . $tag->name . ', ';
        }, '');

        return trim($str, ', ');
    }
}
