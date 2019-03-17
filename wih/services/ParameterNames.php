<?php
/**
 * Created by PhpStorm.
 * User: mattdoran
 * Date: 16/04/2017
 * Time: 10:07
 */

namespace services;


class ParameterNames
{
    //change to constants!!!!!
    static public $offset = 'offset';
    static public $limit = 'limit';
    static public $searchString = 'search';
    static public $category = 'category';
    static public $language = 'language';

    static public $quotes = 'quotes';
    static public $people = 'people';
    static public $books = 'books';
    static public $songs = 'songs';
    static public $films = 'films';

    static public $categories = ['quotes', 'people', 'books', 'songs', 'films'];
}