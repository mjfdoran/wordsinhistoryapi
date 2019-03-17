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

class PeopleModel extends BaseModel
{
    /**
     * Search people
     * @param $searchString
     * @param $offset
     * @param $limit
     * @return array
     * @throws Exception
     */
    public function search($searchString, $offset, $limit, $language = null)
    {
        $query = $this->connection->prepare('
            SELECT p.`id` as `person_id`, p.`name` FROM `people` AS p
            WHERE p.`name` LIKE :searchString
            LIMIT :offset, :limit
        ');

        $searchString = '%' . $searchString . '%';
        $query->bindParam(':searchString', $searchString, PDO::PARAM_STR);
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);

        $this->execute($query);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function add($name)
    {
        $query = $this->connection->prepare('
            INSERT INTO `people` (`name`, `created_at`)
            VALUES (:name, now())');
            
        $query->bindParam(':name', $name, PDO::PARAM_STR);

        $this->execute($query);        

        $lastInsertedId = $this->connection->lastInsertId();        
        $rowCount = $query->rowCount();
        if ($rowCount == 0) {

            throw new DBException('Row count 0 trying to add person with name: ' . $name . ')', 400, 'Person with this name already exists');
        }

        return $lastInsertedId;
    }

    public function get($id)
    {        
        $query = $this->connection->prepare("
            SELECT `id`, `name`, `created_at`, `updated_at`
            FROM `people`            
            WHERE `id` = :id");
        
        $query->bindParam(':id', $id, PDO::PARAM_INT);

        $this->execute($query);

        return $query->fetch(PDO::FETCH_OBJ);        
    }

    //admin
    public function delete($id)
    {
        $query = $this->connection->prepare('
            DELETE FROM `people`            
            WHERE `id` = :id');

        $query->bindParam(':id', $id, PDO::PARAM_INT);

        $this->execute($query);
    }

    //admin
    public function edit($id, $name)
    {
        $query = $this->connection->prepare('
            UPDATE `people`
            SET `name` = :name
            WHERE `id` = :id');

        $query->bindParam(':name', $name, PDO::PARAM_STR);        
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        
        $this->execute($query);
    }

}