<?php

namespace vendor\core;

use Exception;

class App
{
    /**
     * Gets first product by $query
     *
     * @param $query
     * @return array
     * @throws Exception
     */
    public static function getFirstProduct($query)
    {
        $parser = ParserFactory::makeParser('amazon');

        $product = $parser->getFirstProduct($query);

        if ($product) {
            return $product;
        } else {
            throw new Exception('Getting product error.');
        }
    }
}