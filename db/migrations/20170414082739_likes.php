<?php

use Phinx\Migration\AbstractMigration;

class Likes extends AbstractMigration
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
        $this->table('likes_en', array('id' => false, 'primary_key' => array('user_id', 'quote_id')))
            ->addColumn('user_id', 'integer')            
            ->addColumn('quote_id', 'integer')
            ->addColumn('super_like', 'integer', array('null' => true))
            ->addColumn('created_at', 'timestamp', array('default' => false))
            ->addColumn('updated_at', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'))
            ->create();
    }
}
