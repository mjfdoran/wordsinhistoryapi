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

class QuotesModel extends BaseModel
{
    /**     
     * Search quotes
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
            SELECT q.`id` as `quote_id`, q.`words`, q.`total_likes`, q.`super_likes`  FROM `quotes` AS q            
            WHERE q.`words` LIKE :searchString ' . $whereLanguage .
            'ORDER BY q.`super_likes` DESC, q.`total_likes` DESC
            LIMIT :offset, :limit 
        ');

        $searchString = '%' . $searchString . '%';
        $query->bindParam(':searchString', $searchString, PDO::PARAM_STR);
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);

        if($language !== false) {
            $query->bindParam(':language', $language, PDO::PARAM_STR);
        }
        $query->execute();

        if (!$query->execute()) {
            throw new Exception(print_r($query->errorInfo()));
        }

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Get quotes of user with the latest first
     * @param $userId
     * @param $offset
     * @param $limit
     * @return array
     * @throws Exception
     */
    public function getByUser($userId, $offset, $limit)
    {
        $query = $this->connection->prepare('    
            SELECT q.`id`, q.`words`, q.`user_id`, q.`created_at`, count(l.`quote_id`) FROM `quotes` AS q            
            LEFT JOIN `likes` as l ON l.`quote_id` = q.`id`
            WHERE q.`user_id` = :userId
            GROUP BY q.`id`
            ORDER BY q.`created_at` DESC
            LIMIT :offset, :limit;');

        $query->bindParam(':userId', $userId, PDO::PARAM_INT);
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
        
        $this->execute($query);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function detachFromUser($quoteId)
    {
        $query = $this->connection->prepare('
            UPDATE `quotes`
            SET `user_id` = NULL
            WHERE `id` = :quoteId');
    }

    public function delete($quoteId)
    {
        $query = $this->connection->prepare('
            DELETE FROM `quotes`            
            WHERE `id` = :quoteId');

        $query->bindParam(':quoteId', $quoteId, PDO::PARAM_INT);

        $this->execute($query);
    }


    public function add($words, $personId, $bookId, $userId, $information, $language)
    {
        $query = $this->connection->prepare('
            INSERT INTO `quotes` (`words`, `person_id`, `book_id`, `user_id`, `information`, `language`, `created_at`)
            VALUES
                (:words, :personId, :bookId, :userId, :information, :language, now());');

        $query->bindParam(':words', $words, PDO::PARAM_STR);
        $query->bindParam(':personId', $personId, PDO::PARAM_INT);
        $query->bindParam(':bookId', $bookId, PDO::PARAM_INT);        
        $query->bindParam(':userId', $userId, PDO::PARAM_INT);
        $query->bindParam(':information', $information, PDO::PARAM_STR);

        $this->execute($query);
    }


    public function update($id, $words, $personId, $bookId, $userId, $information, $language)
    {
        $query = $this->connection->prepare('
            UPDATE `quotes` 
            SET `words` = :words, `person_id` = :personId, `book_id`= :bookId, `user_id`= :userId, `information` = :information , `language` = :language, `created_at` = now()           
            WHERE `id` = :id');

        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':words', $words, PDO::PARAM_STR);
        $query->bindParam(':personId', $personId, PDO::PARAM_INT);
        $query->bindParam(':bookId', $bookId, PDO::PARAM_INT);        
        $query->bindParam(':userId', $userId, PDO::PARAM_INT);
        $query->bindParam(':information', $information, PDO::PARAM_STR);
    
        $this->execute($query);
    }

    public function approve($id)
    {
        $query = $this->connection->prepare('
            UPDATE `quotes` 
            SET `approve` = 1           
            WHERE `id` = :id');

        $query->bindParam(':id', $id, PDO::PARAM_INT);
    
        $this->execute($query);
    }

}