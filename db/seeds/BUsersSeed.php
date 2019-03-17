<?php

use Phinx\Seed\AbstractSeed;

class BUsersSeed extends AbstractSeed
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

            $newTitle = $faker->email();
            while(in_array($newTitle, $allTitles)){
                $newTitle = $faker->email();
            }
            $allTitles[] = $newTitle;

            $data[] =
                [
                    'name'    => $faker->firstName(),
                    'email'    => $newTitle,
                    'username'    => $faker->username() . (string)$faker->numberBetween(1,10000),
                    'password'    => $faker->password(),
                    'email_verified'    => $faker->boolean(80),
                    'created_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                    'updated_at' => $updateData,
                ];
        }

        $posts = $this->table('users');
        $posts->insert($data)
            ->save();
    }
}
