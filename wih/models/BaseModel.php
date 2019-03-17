<?php

/**
 * Created by PhpStorm.
 * User: mattdoran
 * Date: 10/12/2016
 * Time: 13:00
 */
namespace models;

use PDO;
use Exception;

class BaseModel
{
    protected $connection;    

    public function __construct()
    {
        $this->connection = new PDO("mysql:host=" . getenv('DB_HOST') . ";dbname=" . getenv('DB_NAME'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
        if (getenv('DEBUG') === 'true') {
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }

    protected function getWhere($language)
    {
        if ($language === false) {
            return '';
        }

        return 'AND `language` = :language ';
    }


    protected function execute($query)
    {
        try {
           $query->execute();
        } catch (PDOException $e) {            
            //This shouldn't happen and if it does I don't want to handle it
            error_log('pdo exception with message:' . $e->getMessage() . ' and code: ' . $e->getCode() . ' and info: ' . print_r($query->errorInfo()));
            throw $e;
        }
    }

    /**
    * Valiadation not norally in the model but I have to be certain that the language is always valid
    * If this validation is incorrect the table will not be found and miss leading error message returned
    */
    protected function validateLanguage($language)
    {
        $permittedLanguages = ['en', 'es'];
        if (!in_array($language, $permittedLanguages)) {
            throw new Exception('making query with invalid language' . json_encode($language));
        }
    }

}