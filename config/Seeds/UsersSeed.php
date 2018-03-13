<?php
use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
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
                'name' => 'Admin',
                'username' => 'admin',
                'password' => '$2y$10$NV1tdZmbte9OZalqzvH0L.0yhdgcm0bfYVBQdYN79/bY3GWUHqI52',
                'created' => '2018-03-03 03:11:12',
            ],
            [
                'id' => '2',
                'name' => 'Author',
                'username' => 'author',
                'password' => '$2y$10$4PS/QiVOdRuuYTwMhn8ooOHBVJFRSVwL8kgBGB3NGJ7nLyQAiuMM2',
                'created' => '2018-03-11 06:06:41',
            ],
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
