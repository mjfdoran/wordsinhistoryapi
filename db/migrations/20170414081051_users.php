<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\PostgresAdapter;

class Users extends AbstractMigration
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
        $this->table('users', array('primary_key' => array('id')))
            ->addColumn('name', 'string')
            ->addColumn('email', 'string')
            ->addColumn('username', 'string')
            ->addColumn('password', 'string')            
            ->addColumn('email_verified', 'boolean', array('default' => false))
            ->addColumn('language', 'string', array('default' => 'en')) //default language when they sign in
            ->addIndex(array('email'), array('unique' => true, 'name' => 'idx_email'))
            ->addIndex(array('username'), array('unique' => true, 'name' => 'idx_username'))
            ->addColumn('created_at', 'timestamp', array('default' => false))
            ->addColumn('updated_at', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'))
            ->create();
    }
}
