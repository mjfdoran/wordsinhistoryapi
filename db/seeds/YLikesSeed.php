<?php

use Phinx\Seed\AbstractSeed;

class YLikesSeed extends AbstractSeed
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
        for ($i = 0; $i < 30; $i++) {
            $data[] =
                [
                    'user_id'    => $faker->numberBetween(1, 100),
                    'quote_id'    => $faker->numberBetween(1, 100),
                    'super_like'    => $faker->boolean(1),
                    'created_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                    'updated_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                ];
        }

        $posts = $this->table('likes_en');
        $posts->insert($data)
            ->save();
    }
}
