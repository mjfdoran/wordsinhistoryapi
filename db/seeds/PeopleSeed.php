<?php

use Phinx\Seed\AbstractSeed;

class PeopleSeed extends AbstractSeed
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
        $allTitles =[];
        for ($i = 0; $i < 100; $i++) {
            $updateData = $faker->boolean(20) ? $faker->dateTimeThisYear->format('Y-m-d H:i:s') : null;

            $newTitle = $faker->name();
            while(in_array($newTitle, $allTitles)){
                $newTitle = $faker->name();
            }
            $allTitles[] = $newTitle;

            $data[] =
                [
                    'name'    => $newTitle,
                    'created_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                    'updated_at' => $updateData,
                ];
        }

        $posts = $this->table('people');
        $posts->insert($data)
            ->save();
    }
}
