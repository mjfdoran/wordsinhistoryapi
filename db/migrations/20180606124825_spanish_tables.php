<?php

use Phinx\Migration\AbstractMigration;

class SpanishTables extends AbstractMigration
{
    /**
     * Spanish tables    
     */
    public function change()
    {
		//to add another language simple replace es with en

        $this->table('quotes_es')
            ->addColumn('words', 'string', array('limit' => '1000')) //can't put a unique index because too long -- need to set up a trigger
            ->addColumn('person_id', 'integer')
            ->addColumn('book_id', 'integer', array('null' => true))
            ->addColumn('song_id', 'integer', array('null' => true))
            ->addColumn('film_id', 'integer', array('null' => true))
            ->addColumn('user_id', 'integer', array('null' => true))            
            ->addColumn('approved', 'boolean', array('default' => 0))            
            ->addColumn('total_likes', 'integer', array('default' => '0'))
            ->addColumn('super_likes', 'integer', array('default' => '0'))
            ->addColumn('information', 'string', array('limit' => '1000','null' => true))
            ->addColumn('about_id', 'integer', array('null' => true))
            // ->addColumn('language', 'string', array('default' => 'en', 'null' => false))
            ->addColumn('created_at', 'timestamp', array('default' => false))
            ->addColumn('updated_at', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'))
            ->addIndex(array('words','person_id', 'user_id', 'book_id', 'song_id', 'film_id', 'approved'))
            ->create();

        $this->table('books_es', array('primary_key' => array('id')))
            ->addColumn('name', 'string', array('null' => false))            
            ->addColumn('created_at', 'timestamp', array('default' => false))
            ->addColumn('updated_at', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'))
            ->addIndex(array('name'), array('unique' => true, 'name' => 'idx_books_title_lang'))
            ->create();

        $this->table('songs_es', array('primary_key' => array('id')))
            ->addColumn('name', 'string')            
            ->addIndex(array('name'), array('unique' => true, 'name' => 'idx_songs_title'))
            ->addColumn('created_at', 'timestamp', array('default' => false))
            ->addColumn('updated_at', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'))
            ->create();

        $this->table('films_es', array('primary_key' => array('id')))
            ->addColumn('name', 'string')            
            ->addIndex(array('name'), array('unique' => true, 'name' => 'idx_films_title'))
            ->addColumn('created_at', 'timestamp', array('default' => false))
            ->addColumn('updated_at', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'))
            ->create();

        $this->table('likes_es', array('id' => false, 'primary_key' => array('user_id', 'quote_id')))
            ->addColumn('user_id', 'integer')            
            ->addColumn('quote_id', 'integer')
            ->addColumn('super_like', 'integer', array('null' => true))
            ->addColumn('created_at', 'timestamp', array('default' => false))
            ->addColumn('updated_at', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'))
            ->create();

        $this->table('comments_es', array('primary_key' => array('user_id', 'quote_id')))
            ->addColumn('user_id', 'integer')
            ->addColumn('quote_id', 'integer')            
            ->addColumn('comment', 'string', array('null' => false))
            ->addColumn('created_at', 'timestamp', array('default' => false))
            ->addColumn('updated_at', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'))
            ->create();

            $this->execute('

USE wihapi_local;
DROP TRIGGER IF EXISTS `quote_before_insert`;
DELIMITER $$
CREATE TRIGGER `quote_before_insert` BEFORE INSERT ON `quotes_es`
FOR EACH ROW
BEGIN
    IF ((NEW.book_id IS NOT NULL AND NEW.song_id IS NOT NULL AND NEW.film_id IS NOT NULL) OR 
    (NEW.book_id IS NOT NULL AND NEW.song_id IS NOT NULL) OR
    (NEW.book_id IS NOT NULL AND NEW.film_id IS NOT NULL) OR
    (NEW.song_id IS NOT NULL AND NEW.film_id IS NOT NULL)
    ) THEN
        SIGNAL SQLSTATE \'16001\'
            SET MESSAGE_TEXT = \'Not possible to add a quote with more than one book song or film\';
    END IF;
END$$
DELIMITER;

        ');

    	$this->table('reports_es', array('primary_key' => array('user_id', 'quote_id', 'language')))
            ->addColumn('user_id', 'integer')
            ->addColumn('quote_id', 'integer')            
            ->addColumn('comment', 'string', array('null' => false))
            ->addColumn('created_at', 'timestamp', array('default' => false))
            ->addColumn('updated_at', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'))
            ->create();

                $this->execute('

ALTER TABLE `likes_es`
ADD CONSTRAINT fk_user_id_es
FOREIGN KEY (user_id)
REFERENCES `users` (id);

ALTER TABLE quotes_es
ADD CONSTRAINT fk_person_id_es
FOREIGN KEY (person_id)
REFERENCES people(id);

ALTER TABLE quotes_es
ADD CONSTRAINT fk_about_id_es
FOREIGN KEY (about_id)
REFERENCES people(id);

ALTER TABLE quotes_es
ADD CONSTRAINT fk_book_id_es
FOREIGN KEY (book_id)
REFERENCES books_es(id);

ALTER TABLE quotes_es
ADD CONSTRAINT fk_song_id_es
FOREIGN KEY (song_id)
REFERENCES songs_es(id);

ALTER TABLE quotes_es
ADD CONSTRAINT fk_film_id_es
FOREIGN KEY (film_id)
REFERENCES films_es(id);

ALTER TABLE quotes_es
ADD CONSTRAINT fk_user_id3_es
FOREIGN KEY (user_id)
REFERENCES users(id);

ALTER TABLE users
ADD CONSTRAINT fk_person_id2_es
FOREIGN KEY (person_id)
REFERENCES people(id);

ALTER TABLE users
ADD CONSTRAINT fk_langauge_users_es
FOREIGN KEY (language)
REFERENCES languages(language);

ALTER TABLE `likes_es`
ADD CONSTRAINT fk_delete_likes_es
FOREIGN KEY (quote_id)
REFERENCES `quotes_es` (id)
ON DELETE CASCADE;

ALTER TABLE `likes_es`
ADD CONSTRAINT fk_delete_users_es
FOREIGN KEY (user_id)
REFERENCES `users` (id)
ON DELETE CASCADE;

ALTER TABLE `likes_es`
ADD CONSTRAINT fk_like_language_es
FOREIGN KEY (language)
REFERENCES `languages`(language)
ON DELETE CASCADE;

ALTER TABLE `comments_es`
ADD CONSTRAINT fk_delete_quotes_es
FOREIGN KEY (quote_id)
REFERENCES `quotes_es` (id)
ON DELETE CASCADE;

ALTER TABLE `comments_es`
ADD CONSTRAINT fk_delete_users2_es
FOREIGN KEY (user_id)
REFERENCES `users` (id)
ON DELETE CASCADE;

ALTER TABLE `reports_es`
ADD CONSTRAINT fk_delete_quotes2_es
FOREIGN KEY (quote_id)
REFERENCES `quotes_es` (id)
ON DELETE CASCADE;

ALTER TABLE `reports_es`
ADD CONSTRAINT fk_delete_quotes4_es
FOREIGN KEY (language)
REFERENCES `languages`(language)
ON DELETE CASCADE;

ALTER TABLE `reports_es`
ADD CONSTRAINT fk_delete_users3_es
FOREIGN KEY (user_id)
REFERENCES `users` (id)
ON DELETE CASCADE;

        ');

    }
}
