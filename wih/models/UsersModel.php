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
use exceptions\DBException;

class UsersModel extends BaseModel
{
    //change password
    public function add($name, $email, $username, $password, $defaultLanguage)
    {
        $query = $this->connection->prepare('
            INSERT INTO `users` (`name`, `email`, `username`, `password`, `email_verified`, `language`, `created_at`)
            VALUES (:name, :email, :username, :password, 0, :language, now());');
        
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':language', $defaultLanguage, PDO::PARAM_STR);

        $this->execute($query);

        $lastInsertedId = $this->connection->lastInsertId();
        $rowCount = $query->rowCount();

        if ($rowCount == 0) {

            throw new DBException('Row count 0 trying to add user with name: ' . $name . ' email: ' . $email . ' and language: ' . $defaultLanguage . ')', 400, 'User email or username already exists');
        }

        return $lastInsertedId;
    }

    //admin
    public function delete($id)
    {
        $query = $this->connection->prepare('
            DELETE FROM `users`            
            WHERE `id` = :id');

        $query->bindParam(':id', $id, PDO::PARAM_INT);

        $this->execute($query);
    }


    //admin
    public function edit($user)
    {
        if (empty($user->id)) {
            throw new Exception('Trying to update a user without an id');
        }
        
        $selectString = '';
        if (isset($user->name)) {
            $selectString .= '`name` = :name,';
        }
        if (isset($user->email)) {
            $selectString .= '`email` = :email,';
        }
        if (isset($user->username)) {
            $selectString .= '`username` = :username,';
        }
        if (isset($user->language)) {
            $selectString .= '`language` = :language,';
        }
        $selectString = rtrim($selectString,",");


        echo $selectString;
        $query = $this->connection->prepare("
            UPDATE `users`
            SET $selectString             
            WHERE `id` = :id");

        echo 'user id is ' . $user->id;
        $query->bindParam(':id', $user->id, PDO::PARAM_INT);
        if (isset($user->name)) {
            echo 'name';
            $query->bindParam(':name', $user->name, PDO::PARAM_STR);
        }
        if (isset($user->email)) {
            echo 'email';
            $query->bindParam(':email', $user->email, PDO::PARAM_STR);
        }
        if (isset($user->username)) {
            echo 'username';
            $query->bindParam(':username', $user->username, PDO::PARAM_STR);
        }
        if (isset($user->language)) {
            echo 'language';
            $query->bindParam(':language', $user->language, PDO::PARAM_STR);
        }

        $this->execute($query);

        echo $this->connection->errorCode();

    }

    public function get($id)
    {
        $query = $this->connection->prepare('
            SELECT `id`, `name`, `email`, `username`, `email_verified`, `language`, `created_at`
            FROM `users`             
            WHERE `id` = :id');

        $query->bindParam(':id', $id, PDO::PARAM_INT);

        $this->execute($query);

        return $query->fetch(PDO::FETCH_OBJ);
    }


    //change email needs a bit of thought
}