<?php

use Phinx\Migration\AbstractMigration;

class Quotes extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $this->table('quotes_en')
            ->addColumn('words', 'string', array('limit' => '1000')) //can't put a unique index because too long -- need to set up a trigger
            ->addColumn('person_id', 'integer')
            ->addColumn('book_id', 'integer', array('null' => true))
            // ->addColumn('song_id', 'integer', array('null' => true))
            // ->addColumn('film_id', 'integer', array('null' => true))
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
    }
}
