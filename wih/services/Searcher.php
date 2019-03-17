<?php
/**
 * Created by PhpStorm.
 * User: mattdoran
 * Date: 16/04/2017
 * Time: 10:52
 */

namespace services;

use Exception;
use models\SearchModel;

class Searcher
{
    private $results;
    private $categories = [];
    private $searchModel;

    public function __construct()
    {
        $this->categories = [ParameterNames::$quotes, ParameterNames::$people, ParameterNames::$books, ParameterNames::$songs, ParameterNames::$films];
        $this->searchModel = new SearchModel();
        $this->results = [];
    }


    /**
     * Search through all the categories/tables looking for matches
     * If there are more results return the next category/table and the next offset
     * @param $searchString
     * @param $offset
     * @param $limit
     * @param $category
     * @return mixed
     * @throws Exception
     */
    public function search($searchString, $offset, $limit, $category, $language)
    {
        if (!in_array($category, $this->categories)) {
            throw new Exception('Searching in category that does not exist');
        }

        //get category/table to start search
        $categoryTable = array_search($category, $this->categories);

        //search through tables
        while (count($this->results) < $limit) {

            if (!isset($this->categories[$categoryTable])) {
                //no more results
                return SearchResultFormatter::returnResults($this->results, null, null, false);
            }

            //search category/table for results
            $function = 'search' . ucfirst($this->categories[$categoryTable]);
            $resultsAlreadyFetched = count($this->results);
            $newLimit = ($limit - $resultsAlreadyFetched);
            $moreResults = $this->searchModel->$function($searchString, $offset, $newLimit, $language);
            $this->results = array_merge($this->results, $moreResults);

            if (count($this->results) === $limit) {

                //there are more results if requested
                $newOffset = (count($moreResults) + $offset);
                $category = $this->categories[$categoryTable];

                return SearchResultFormatter::returnResults($this->results, $newOffset, $category, true);
            }

            //set offset to 0 to search the next table
            $offset = 0;
            $categoryTable++;
        }

        throw new Exception('Returning more results than requested');
    }
}