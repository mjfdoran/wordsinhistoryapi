<?php
/**
 * Created by PhpStorm.
 * User: mattdoran
 * Date: 14/04/2017
 * Time: 15:03
 */

namespace controllers;

use models\WordsModel;
use services\ParameterRetriever;
use services\Searcher;

class SearchController
{
    private $parameterRetriever;

    public function __construct($request)
    {
        $this->parameterRetriever = new ParameterRetriever($request->getQueryParams());
    }

    public function searchWords()
    {
        $searcher = new Searcher();
        $results = $searcher->search(
            $this->parameterRetriever->getSearchString(),
            $this->parameterRetriever->getOffset(),
            $this->parameterRetriever->getLimit(),
            $this->parameterRetriever->getCategory(),
            $this->parameterRetriever->getLanguage()
        );

        return $results;
    }


    public function searchWordsByBooks()
    {

    }

    public function searchWordsByPeople()
    {

    }

    public function searchWordsBySongs()
    {

    }

    public function searchWordsByFilms()
    {

    }

}