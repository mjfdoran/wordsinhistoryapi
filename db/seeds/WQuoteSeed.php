<?php

use Phinx\Seed\AbstractSeed;

class WQuoteSeed extends AbstractSeed
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
        $j = 1;
        $allTitles = [];
        for ($i = 0; $i < 10000; $i++) {
            $updateData = $faker->boolean(20) ? $faker->dateTimeThisYear->format('Y-m-d H:i:s') : null;

            $newTitle = $faker->realText(300);
            while(in_array($newTitle, $allTitles)){
                $newTitle = $faker->realText(300);
            }
            $allTitles[] = $newTitle;

            
            $noMedia = $faker->boolean(20); //20% chance of true            
            
            //PROBLEM IS WE WILL ALWASY GET DUPLICATIONS
            if ($noMedia == true) {
                $bookId = null;
                $songId = null;
                $filmId = null;
            } else {

                $bookFilmSong = $faker->numberBetween(1, 3);
                switch ($bookFilmSong) {
                    case 1:
                        $bookId = $faker->numberBetween(1, 100);
                        $songId = null;
                        $filmId = null;
                        break; 
                    case 2:
                        $songId = $faker->numberBetween(1, 100);
                        $filmId = null;
                        $bookId = null;
                        break;
                    case 3:
                        $filmId = $faker->numberBetween(1, 100);
                        $bookId = null;
                        $songId = null;
                        break;
                }

            }
         

            if ($i % 2 == 0) {
                $data[] =
                    [
                        'words'    => $newTitle,
                        'person_id' => $faker->numberBetween(1, 100),
                        'book_id' => $bookId,
                        'film_id' => $filmId,
                        'song_id' => $songId,
                        'user_id' => $faker->numberBetween(1, 100),
                        'total_likes' => $faker->numberBetween(1, 100),
                        'super_likes' => $faker->numberBetween(1, 100),
                        'information' => $faker->realText(100),
                        'about_id' => $faker->numberBetween(1, 100),
                        'created_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                        'updated_at' => $updateData                        
                    ];
            } else {

                if ($j < 101){
                    $data[] =
                        [
                            'words'    => $newTitle,
                            'person_id' => $j,
                            'book_id' => $bookId,
                            'film_id' => $filmId,
                            'song_id' => $songId,
                            'user_id' => $faker->numberBetween(1, 100),
                            'total_likes' => $faker->numberBetween(1, 100),
                            'super_likes' => $faker->numberBetween(1, 100),
                            'information' => $faker->realText(100),
                            'created_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                            'updated_at' => $updateData                            
                        ];
                }
                $j++;
            }


        }

        $posts = $this->table('quotes_en');
        $posts->insert($data)
            ->save();
    }
}

