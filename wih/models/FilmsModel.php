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


/**
* For the moment I have not going to include films in this search
* When i do this model will need to be updated like books
**/

class FilmsModel extends BaseModel
{
    /**
     * Search films
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
            SELECT f.`id` as `film_id`, f.`name` FROM `films` AS f
            WHERE f.`name` LIKE :searchString ' . $whereLanguage .
            'LIMIT :offset, :limit
        ');

        $searchString = '%' . $searchString . '%';
        $query->bindParam(':searchString', $searchString, PDO::PARAM_STR);
        $query->bindParam(':language', $language, PDO::PARAM_STR);
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
        if($language !== false) $query->bindParam(':language', $language, PDO::PARAM_STR);

        $this->execute($query);    

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add()
    {
        $query = $this->connection->prepare('
            INSERT INTO `films` (`name`, `language`, `created_at`)
            VALUES (:name, :language ,now())');
        
        $query->bindParam(':name', $id, PDO::PARAM_STR);
        $query->bindParam(':language', $id, PDO::PARAM_STR);

        $this->execute($query);
    }

    //admin
    public function delete($id)
    {
        $query = $this->connection->prepare('
            DELETE FROM `films`            
            WHERE `id` = :id');

        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $this->execute($query);
    }

    //admin
    public function edit($id, $name, $language)
    {
        $query = $this->connection->prepare('
            UPDATE `films`
            SET `name` = :name, `language` = :language
            WHERE `id` = :id');

        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':language', $language, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $this->execute($query);
    }

}