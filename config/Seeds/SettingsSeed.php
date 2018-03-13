<?php
use Migrations\AbstractSeed;

/**
 * Settings seed.
 */
class SettingsSeed extends AbstractSeed
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
                'name' => 'Site Title',
                'input_key' => 'site_title',
                'input_value' => 'Your Site Title',
                'input_type' => 'text',
            ],
            [
                'id' => '2',
                'name' => 'Site Tagline',
                'input_key' => 'site_tagline',
                'input_value' => 'Your Site Tagline Lorem Ipsum Sit Amet',
                'input_type' => 'text',
            ],
            [
                'id' => '3',
                'name' => 'SIte Description',
                'input_key' => 'site_description',
                'input_value' => 'Your Meta Description for your Site',
                'input_type' => 'textarea',
            ],
            [
                'id' => '4',
                'name' => 'Site Logo',
                'input_key' => 'site_logo',
                'input_value' => '',
                'input_type' => 'text',
            ],
            [
                'id' => '5',
                'name' => 'Site Email',
                'input_key' => 'site_email',
                'input_value' => 'admin@example.com',
                'input_type' => 'email',
            ],
            [
                'id' => '6',
                'name' => 'Articles/Page',
                'input_key' => 'articles_page',
                'input_value' => '2',
                'input_type' => 'number',
            ],
        ];

        $table = $this->table('settings');
        $table->insert($data)->save();
    }
}
