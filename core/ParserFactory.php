<?php

namespace vendor\core;

use Exception;
use vendor\parsers\AmazonParser;

class ParserFactory
{
    /**
     * Creates an object of specific subclass of Parser class
     *
     * @param $parserType
     * @return AmazonParser|null
     * @throws Exception
     */
    public static function makeParser($parserType)
    {
        if ($parserType === 'amazon') {
            $parser = new AmazonParser();
        } else {
            throw new Exception('Parser type is incorrect');
        }

        return $parser;
    }
}