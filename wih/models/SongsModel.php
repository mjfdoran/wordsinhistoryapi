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

class SongsModel extends BaseModel
{
    /**
     * Search songs
     * @param $searchString
     * @param $offset
     * @param $limit
     * @return array
     * @throws Exception
     */
    public function search($searchString, $offset, $limit, $language)
    {
        $whereLanguage = $this->getWhere($language);
        $query = $this->connection->prepare('
            SELECT s.`id` as `song_id`, s.`name` FROM `songs` AS s
            WHERE s.`name` LIKE :searchString ' . $whereLanguage .
            'LIMIT :offset, :limit
        ');

        $searchString = '%' . $searchString . '%';
        $query->bindParam(':searchString', $searchString, PDO::PARAM_STR);
        $query->bindParam(':language', $language, PDO::PARAM_STR);
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
        if($language !== false) $query->bindParam(':language', $language, PDO::PARAM_STR);
        $query->execute();

        if (!$query->execute()) {
            throw new Exception(print_r($query->errorInfo()));
        }

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function add()
    {
        $query = $this->connection->prepare('
            INSERT INTO `songs` (`name`, `language`, `created_at`)
            VALUES (:name, :language ,now())');
        
        $query->bindParam(':name', $id, PDO::PARAM_STR);
        $query->bindParam(':language', $id, PDO::PARAM_STR);

        $this->execute($query);
    }

    //admin
    public function delete($id)
    {
        $query = $this->connection->prepare('
            DELETE FROM `songs`            
            WHERE `id` = :id');

        $query->bindParam(':id', $id, PDO::PARAM_INT);
        
        $this->execute($query);
    }

    //admin
    public function edit($id, $name, $language)
    {
        $query = $this->connection->prepare('
            UPDATE `songs`
            SET `name` = :name, `language` = :language
            WHERE `id` = :id');

        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':language', $language, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_INT);

        $this->execute($query);
    }
}