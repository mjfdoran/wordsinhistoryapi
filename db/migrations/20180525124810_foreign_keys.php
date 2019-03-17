<?php

use Phinx\Migration\AbstractMigration;

class ForeignKeys extends AbstractMigration
{
    public function change()
    {		
        $this->execute('

ALTER TABLE `likes_en`
ADD CONSTRAINT fk_user_id
FOREIGN KEY (user_id)
REFERENCES `users` (id);

ALTER TABLE quotes_en
ADD CONSTRAINT fk_person_id
FOREIGN KEY (person_id)
REFERENCES people(id);

ALTER TABLE quotes_en
ADD CONSTRAINT fk_about_id
FOREIGN KEY (about_id)
REFERENCES people(id);

ALTER TABLE quotes_en
ADD CONSTRAINT fk_book_id
FOREIGN KEY (book_id)
REFERENCES books_en(id);

ALTER TABLE quotes_en
ADD CONSTRAINT fk_song_id
FOREIGN KEY (song_id)
REFERENCES songs_en(id);

ALTER TABLE quotes_en
ADD CONSTRAINT fk_film_id
FOREIGN KEY (film_id)
REFERENCES films_en(id);

ALTER TABLE quotes_en
ADD CONSTRAINT fk_user_id3
FOREIGN KEY (user_id)
REFERENCES users(id);

ALTER TABLE users
ADD CONSTRAINT fk_person_id2
FOREIGN KEY (person_id)
REFERENCES people(id);

ALTER TABLE users
ADD CONSTRAINT fk_langauge_users
FOREIGN KEY (language)
REFERENCES languages(language);

ALTER TABLE `likes_en`
ADD CONSTRAINT fk_delete_likes
FOREIGN KEY (quote_id)
REFERENCES `quotes_en` (id)
ON DELETE CASCADE;

ALTER TABLE `likes_en`
ADD CONSTRAINT fk_delete_users
FOREIGN KEY (user_id)
REFERENCES `users` (id)
ON DELETE CASCADE;

ALTER TABLE `likes_en`
ADD CONSTRAINT fk_like_language
FOREIGN KEY (language)
REFERENCES `languages`(language)
ON DELETE CASCADE;

ALTER TABLE `comments_en`
ADD CONSTRAINT fk_delete_quotes
FOREIGN KEY (quote_id)
REFERENCES `quotes_en` (id)
ON DELETE CASCADE;

ALTER TABLE `comments_en`
ADD CONSTRAINT fk_delete_users2
FOREIGN KEY (user_id)
REFERENCES `users` (id)
ON DELETE CASCADE;

ALTER TABLE `reports_en`
ADD CONSTRAINT fk_delete_quotes2
FOREIGN KEY (quote_id)
REFERENCES `quotes_en` (id)
ON DELETE CASCADE;

ALTER TABLE `reports_en`
ADD CONSTRAINT fk_delete_quotes4
FOREIGN KEY (language)
REFERENCES `languages`(language)
ON DELETE CASCADE;

ALTER TABLE `reports_en`
ADD CONSTRAINT fk_delete_users3
FOREIGN KEY (user_id)
REFERENCES `users` (id)
ON DELETE CASCADE;

        ');
    }
}
