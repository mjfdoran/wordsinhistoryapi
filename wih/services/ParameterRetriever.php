<?php
/**
 * Created by PhpStorm.
 * User: mattdoran
 * Date: 15/04/2017
 * Time: 15:36
 */

namespace services;

class ParameterRetriever
{
    private $parameterArray;
    public $searchString;

    public function __construct(Array $parametersArray)
    {
        $this->parameterArray = $parametersArray;
    }

    public function getSearchString()
    {
        return $this->searchString = $this->getString(ParameterNames::$searchString, '');
    }

    public function getLanguage()
    {
        return $this->getString(ParameterNames::$language, false);
    }

    public function getOffset($default = 0)
    {
        return $this->getNumber(ParameterNames::$offset, $default);
    }

    public function getLimit($limit = 100)
    {
        return $this->getNumber(ParameterNames::$limit, $limit, 1000);
    }

    public function getCategory()
    {
        if (!isset($this->parameterArray[ParameterNames::$category])) {
            return ParameterNames::$categories[0];
        }

        if (!in_array($this->parameterArray[ParameterNames::$category], ParameterNames::$categories)) {
            return ParameterNames::$categories[0];
        }

        return $this->parameterArray[ParameterNames::$category];
    }

    private function getNumber($parameter, $default, $maxNumber = null)
    {
        if (!isset($this->parameterArray[$parameter])) {
            return (int)$default;
        }

        if (!is_numeric($this->parameterArray[$parameter])){
            return $default;
        }

        if ($maxNumber === null) {
            return (int)$this->parameterArray[$parameter];
        }

        if ($this->parameterArray[$parameter] > $maxNumber) {
            return $maxNumber;
        }

        return (int)$this->parameterArray[$parameter];
    }

    private function getString($parameter, $default)
    {
        if (!isset($this->parameterArray[$parameter])) {
            return $default;
        }
        if (!is_string($this->parameterArray[$parameter])) {
            return $default;
        }

        return $this->parameterArray[$parameter];
    }

}