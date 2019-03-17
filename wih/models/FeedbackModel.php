<?php
/**
 * Created by PhpStorm.
 * User: mattdoran
 * Date: 10/12/2016
 * Time: 12:59
 */
namespace models;

use Exception;
use PDO;

class FeedbackModel extends BaseModel
{
    //this is an "email" sent form the site

    //admin    
    public function add()
    {
        $query = $this->connection->prepare('
            INSERT INTO `feedback` (`user_id`, `email`, `message`, `created_at`)
            VALUES (:userId, :email, :message, now());');

        $query->bindParam(':name', $id, PDO::PARAM_STR);
        $query->bindParam(':language', $id, PDO::PARAM_STR);

        $this->execute($query);
    }

    //admin
    public function delete($id)
    {
        $query = $this->connection->prepare('
            DELETE FROM `feedback`            
            WHERE `id` = :id');

        $query->bindParam(':id', $id, PDO::PARAM_INT);
        
        $this->execute($query);
    }

}