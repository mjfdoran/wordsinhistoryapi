<?php
/**
 * Created by PhpStorm.
 * User: mattdoran
 * Date: 10/12/2016
 * Time: 12:59
 */
namespace models;

use Exception;
use exceptions\DBException;
use PDO;

class BooksModel extends BaseModel
{
    /**
     * Search books
     * @param $searchString
     * @param $offset
     * @param $limit
     * @return array
     * @throws Exception
     */
    public function search($searchString, $offset, $limit, $language)
    {
        $query = $this->connection->prepare("
            SELECT b.`id` as `book_id`, b.`name` FROM `books_$language` AS b
            WHERE b.`name` LIKE :searchString 
            LIMIT :offset, :limit
        ");

        $searchString = '%' . $searchString . '%';
        $query->bindParam(':searchString', $searchString, PDO::PARAM_STR);
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
                
        $this->execute($query);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }


    
    public function add($name, $language)
    {        
        $query = $this->connection->prepare("
            INSERT INTO `books_$language` (`name`, `created_at`)
            VALUES (:name ,now())");

        $query->bindParam(':name', $name, PDO::PARAM_STR);
        
        $this->execute($query);        

        $lastInsertedId = $this->connection->lastInsertId();
        $rowCount = $query->rowCount();

        if ($rowCount == 0) {

            throw new DBException('Row count 0 trying to add books with name: ' . $name . ' and language: ' . $language . ')', 400, 'Book already exists');
        }
        
        return $lastInsertedId;        
    }

    public function get($id, $language)
    {        
        $query = $this->connection->prepare("
            SELECT `id`, `name`, `created_at`, `updated_at`
            FROM `books_$language`            
            WHERE `id` = :id");
        
        $query->bindParam(':id', $id, PDO::PARAM_INT);

        $this->execute($query);

        return $query->fetch(PDO::FETCH_OBJ);        
    }

    //admin
    public function delete($id, $language)
    {
        $query = $this->connection->prepare("
            DELETE FROM `books_$language`            
            WHERE `id` = :id");

        $query->bindParam(':id', $id, PDO::PARAM_INT);
        
        $this->execute($query);
    }

    //admin
    public function edit($id, $name, $language)
    {
        $query = $this->connection->prepare("
            UPDATE `books_$language`
            SET `name` = :name
            WHERE `id` = :id");

        $query->bindParam(':name', $name, PDO::PARAM_STR);        
        $query->bindParam(':id', $id, PDO::PARAM_INT);

        $this->execute($query);
    }

}