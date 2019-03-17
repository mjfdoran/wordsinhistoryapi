<?php

use Phinx\Migration\AbstractMigration;

class Feedback extends AbstractMigration
{
    public function change()
    {
        $this->table('feedback', array('primary_key' => array('id')))
            ->addColumn('user_id', 'integer', array('null' => true))
            ->addColumn('email', 'string', array('null' => true))                    
            ->addColumn('message', 'string', array('limit' => '255'))            
            ->addColumn('created_at', 'timestamp', array('default' => false))
            ->addColumn('updated_at', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'))
            ->create();
    }
}
