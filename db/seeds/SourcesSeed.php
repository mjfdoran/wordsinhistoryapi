<?php

use Phinx\Seed\AbstractSeed;

class SourcesSeed extends AbstractSeed
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
//        $faker = Faker\Factory::create();
//
//        $data = [];
//        $quoteIds = [];
//        for ($i = 0; $i < 300; $i++) {
//            $updateData = $faker->boolean(20) ? $faker->dateTimeThisYear->format('Y-m-d H:i:s') : null;
//            $newQuoteId = $faker->numberBetween(1, 1000);
//            while (in_array($newQuoteId, $quoteIds))  {
//                $newQuoteId = $faker->numberBetween(1, 1000);
//            }
//            $quoteIds[] = $newQuoteId;
//            $data[] =
//                [
//                    'quote_id' => $newQuoteId,
//                    'person_id' => $faker->numberBetween(1, 100),
//                    'book_id' => ($faker->boolean(8)  ? $faker->numberBetween(1, 100) : null),
//                    'film_id' => ($faker->boolean(8)  ? $faker->numberBetween(1, 100) : null),
//                    'song_id' => ($faker->boolean(8)  ? $faker->numberBetween(1, 100) : null),
//                    'user_id' => $faker->numberBetween(1, 100),
//                    'total_likes' => $faker->numberBetween(1, 100),
//                    'super_likes' => ($faker->boolean(3)  ? 1 : 0),
//                    'created_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
//                    'updated_at' => $updateData,
//                ];
//        }
//
//        $posts = $this->table('sources');
//        $posts->insert($data)
//            ->save();
    }
}
