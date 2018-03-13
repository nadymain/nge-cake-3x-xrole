<?php
use Migrations\AbstractSeed;

/**
 * ArticlesTags seed.
 */
class ArticlesTagsSeed extends AbstractSeed
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
                'article_id' => '1',
                'tag_id' => '1',
            ],
        ];

        $table = $this->table('articles_tags');
        $table->insert($data)->save();
    }
}
