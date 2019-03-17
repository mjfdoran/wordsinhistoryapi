<?php
/**
 * Created by PhpStorm.
 * User: mattdoran
 * Date: 10/12/2016
 * Time: 12:59
 */
namespace models;

/**
 * This model allows me to search all models using dynamic functions inside the Searcher.php
 * Class QuotesModel
 * @package models
 */
class SearchModel extends BaseModel
{
    /**
     * Call search on quotes model
     * @param $searchString
     * @param $offset
     * @param $limit
     */
    public function searchQuotes($searchString, $offset, $limit, $language)
    {
        $quotesModel = new QuotesModel();

        return $quotesModel->search($searchString, $offset, $limit, $language);
    }


    /**
     * Call search on people model
     * @param $searchString
     * @param $offset
     * @param $limit
     */
    public function searchPeople($searchString, $offset, $limit, $language)
    {
        $peopleModel = new PeopleModel();

        return $peopleModel->search($searchString, $offset, $limit, $language);
    }


    /**
     * Call search on books model
     * @param $searchString
     * @param $offset
     * @param $limit
     */
    public function searchBooks($searchString, $offset, $limit, $language)
    {
        $booksModel = new BooksModel();

        return $booksModel->search($searchString, $offset, $limit, $language);
    }


    /**
     * Call search on songs model
     * @param $searchString
     * @param $offset
     * @param $limit
     */
    public function searchSongs($searchString, $offset, $limit, $language)
    {
        $songsModel = new SongsModel();

        return $songsModel->search($searchString, $offset, $limit, $language);
    }


    /**
     * Call search on films model
     * @param $searchString
     * @param $offset
     * @param $limit
     */
    public function searchFilms($searchString, $offset, $limit, $language)
    {
        $filmsModel = new FilmsModel();

        return $filmsModel->search($searchString, $offset, $limit, $language);
    }

}