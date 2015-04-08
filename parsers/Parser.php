<?php

namespace vendor\parsers;

use Exception;
use phpQuery;

abstract class Parser
{
    /**
     * Gets content by $url in phpQuery Document format
     *
     * @param $url
     * @return phpQueryObject|QueryTemplatesParse|QueryTemplatesSource|QueryTemplatesSourceQuery|string
     * @throws Exception
     */
    protected function phpQueryDocument($url)
    {
        $document = file_get_contents($url);

        if ($document) {
            $document = phpQuery::newDocument($document);
        } else {
            throw new Exception('Getting content by URL problem. URL: '.$url.PHP_EOL);
        }

        return $document;
    }
}