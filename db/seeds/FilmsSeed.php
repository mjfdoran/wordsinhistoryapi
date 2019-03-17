<?php

use Phinx\Seed\AbstractSeed;

class FilmsSeed extends AbstractSeed
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
        $faker = Faker\Factory::create();
        $data = [];
        $allTitles = [];
        for ($i = 0; $i < 100; $i++) {
            $updateData = $faker->boolean(20) ? $faker->dateTimeThisYear->format('Y-m-d H:i:s') : null;

            $newTitle = $faker->realText(40);
            while(in_array($newTitle, $allTitles)){
                $newTitle = $faker->realText(40);
            }
            $allTitles[] = $newTitle;

            $random = rand(0, 1);
            $language = ($random === 0) ? 'en' : 'es';

            $data[] =
                [
                    'name'    => $newTitle,
                    // 'language' => $language,
                    'created_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                    'updated_at' => $updateData,
                ];
        }

        $posts = $this->table('films_en');
        $posts->insert($data)
            ->save();
    }
}
