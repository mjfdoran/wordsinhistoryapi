<?php

use Phinx\Migration\AbstractMigration;

class Books extends AbstractMigration
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
        $this->table('books_en', array('primary_key' => array('id')))
            ->addColumn('name', 'string', array('null' => false))            
            ->addColumn('created_at', 'timestamp', array('default' => false))
            ->addColumn('updated_at', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'))
            ->addIndex(array('name'), array('unique' => true, 'name' => 'idx_books_title_lang'))
            ->create();
    }
}
