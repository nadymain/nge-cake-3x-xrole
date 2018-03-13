<?php
use Migrations\AbstractSeed;

/**
 * Menu seed.
 */
class MenuSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'name' => 'Home',
                'link' => '/',
                'parent_id' => NULL,
                'lft' => '1',
                'rght' => '2',
            ],
            [
                'id' => '2',
                'name' => 'Blog',
                'link' => '/blog',
                'parent_id' => NULL,
                'lft' => '3',
                'rght' => '4',
            ],
            [
                'id' => '3',
                'name' => 'Contact',
                'link' => '/contact',
                'parent_id' => NULL,
                'lft' => '5',
                'rght' => '6',
            ],
            [
                'id' => '4',
                'name' => 'Login',
                'link' => '/logged/in',
                'parent_id' => NULL,
                'lft' => '7',
                'rght' => '8',
            ],
            [
                'id' => '5',
                'name' => 'Drop',
                'link' => '#',
                'parent_id' => NULL,
                'lft' => '9',
                'rght' => '14',
            ],
            [
                'id' => '6',
                'name' => 'Down 1',
                'link' => '/logged/in',
                'parent_id' => '5',
                'lft' => '10',
                'rght' => '11',
            ],
            [
                'id' => '7',
                'name' => 'Down 2',
                'link' => '/blog',
                'parent_id' => '5',
                'lft' => '12',
                'rght' => '13',
            ],
        ];

        $table = $this->table('menus');
        $table->insert($data)->save();
    }
}
