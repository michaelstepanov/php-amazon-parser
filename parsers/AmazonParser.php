<?php

namespace vendor\parsers;

use Exception;

class AmazonParser extends Parser
{
    const ID = 1; // parser ID
    const MAIN_PAGE = 'http://www.amazon.com/';
    const SEARCH_URL = 'http://www.amazon.com/s/ref=nb_sb_noss?url=search-alias%3Daps&field-keywords=';

    /**
     * Gets first product from the list of products
     *
     * @param $query
     * @return array
     * @throws Exception
     */
    public function getFirstProduct($query)
    {
        $url = self::SEARCH_URL . urlencode($query);

        $products = $this->phpQueryDocument($url);

        // finds first product element on the page
        // here may be other elements containing first product, with other ID
        $firstProduct = $products->find('#result_0');

        // if first product exists
        if ($firstProduct->length) {
            // gets array of product's Title, Price, Image URL and Description
            $product = $this->getProduct($firstProduct);

            return $product;
        } else {
            throw new Exception('Your search "'.$query.'" did not match any products.');
        }
    }

    /**
     * Gets product's Title, Price, Image URL and Description
     *
     * @param $product
     * @return array
     */
    private function getProduct($product)
    {
        return array(
            'title' => $this->getTitle($product),
            'price' => $this->getPrice($product),
            'imgUrl' => $this->getImgUrl($product),
            'description' => $this->getDescription($product),
        );
    }

    /**
     * Gets product's Title
     *
     * @param $product
     * @return mixed
     */
    private function getTitle($product)
    {
        return $product->find('h2')->text();
    }

    /**
     * Gets product's Price
     *
     * @param $product
     * @return mixed
     */
    private function getPrice($product)
    {
        return $product->find('.a-size-base.a-color-price.a-text-bold:first')->text();
    }

    /**
     * Gets product's Image URL
     *
     * @param $product
     * @return mixed
     */
    private function getImgUrl($product)
    {
        return $product->find('img:first')->attr('src');
    }

    /**
     * Gets product's Description
     *
     * @param $product
     * @return phpQuery|QueryTemplatesParse|QueryTemplatesSource|QueryTemplatesSourceQuery|string
     * @throws Exception
     */
    private function getDescription($product)
    {
        $description = '';

        $descriptionUrl = $this->getDescriptionUrl($product);

        if ($descriptionUrl) {
            $descriptionData = $this->phpQueryDocument($descriptionUrl);

            // here may be other elements containing description of the product, with other ID and classes
            if ($descriptionData->find('#productDescription .productDescriptionWrapper')->html()) {
                $description = $descriptionData->find('#productDescription .productDescriptionWrapper')->html();
            } elseif ($descriptionData->find('#ps-content .content')->html()) {
                $description = $descriptionData->find('#ps-content .content')->html();
            }

            $description = trim($description);
        }

        return $description;
    }

    /**
     * Gets product's Description URL
     *
     * @param $product
     * @return mixed
     */
    private function getDescriptionUrl($product)
    {
        return $product->find('img')->parent('a')->attr('href');
    }
}