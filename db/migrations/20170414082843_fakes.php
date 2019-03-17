<?php

use Phinx\Migration\AbstractMigration;

class Fakes extends AbstractMigration
{
    //This are comments added
    public function change()
    {
        $this->table('comments_en', array('primary_key' => array('user_id', 'quote_id')))
            ->addColumn('user_id', 'integer')
            ->addColumn('quote_id', 'integer')            
            ->addColumn('comment', 'string', array('null' => false))
            ->addColumn('created_at', 'timestamp', array('default' => false))
            ->addColumn('updated_at', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'))
            ->create();
    }
}
