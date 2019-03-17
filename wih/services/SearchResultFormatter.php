<?php
/**
 * Created by PhpStorm.
 * User: mattdoran
 * Date: 16/04/2017
 * Time: 10:02
 */

namespace services;


class SearchResultFormatter
{
    static public function returnResults($results, $nextOffset, $category, $moreResults)
    {
        $response['results'] = $results;
        $response['nextOffset'] = (int)$nextOffset;
        $response['nextCategory'] = (string)$category;
        $response['moreResults'] = (boolean)$moreResults;

        return $response;
    }
}