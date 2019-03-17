<?php

use Phinx\Seed\AbstractSeed;

/**
delete from `books_en`;
ALTER TABLE `books_en` AUTO_INCREMENT = 1;
delete from `comments_en`;
ALTER TABLE `comments_en` AUTO_INCREMENT = 1;
delete from `films_en`;
ALTER TABLE `films_en` AUTO_INCREMENT = 1;
delete from `quotes_en`;
ALTER TABLE `quotes_en` AUTO_INCREMENT = 1;
delete from `songs_en`;
ALTER TABLE `songs_en` AUTO_INCREMENT = 1;
delete from `users`;
ALTER TABLE `users` AUTO_INCREMENT = 1;
delete from `people`;
ALTER TABLE `people` AUTO_INCREMENT = 1;
delete from `likes_en`;
ALTER TABLE `likes_en` AUTO_INCREMENT = 1;
delete from `languages`;
ALTER TABLE `languages` AUTO_INCREMENT = 1;
**/

class ALanguageSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [];
        $languages = ['en', 'fr', 'es', 'it'];

        foreach($languages as $language) {
            $data[] = ['language'    => $language];
        }

        $posts = $this->table('languages');
        $posts->insert($data)
            ->save();
    }
}
