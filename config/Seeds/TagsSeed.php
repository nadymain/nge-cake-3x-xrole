<?php
use Migrations\AbstractSeed;

/**
 * Tags seed.
 */
class TagsSeed extends AbstractSeed
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
                'name' => 'Untag',
                'slug' => 'untag',
                'description' => NULL,
                'article_count' => '1',
                'created' => '2018-03-12 09:47:30',
            ],
        ];

        $table = $this->table('tags');
        $table->insert($data)->save();
    }
}
