<?php

use Phinx\Migration\AbstractMigration;

class OnlyAllowOneQuoteSource extends AbstractMigration
{
    public function change()
    {
        $this->execute('

USE wihapi_local;
DROP TRIGGER IF EXISTS `quote_before_insert`;
DELIMITER $$
CREATE TRIGGER `quote_before_insert` BEFORE INSERT ON `quotes_en`
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
    }
}
