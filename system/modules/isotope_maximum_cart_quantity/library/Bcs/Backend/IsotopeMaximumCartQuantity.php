<?php

/**
 * Bright Cloud Studio's GAI Invoices
 *
 * Copyright (C) 2022-2023 Bright Cloud Studio
 *
 * @package    bright-cloud-studio/gai-invoices
 * @link       https://www.brightcloudstudio.com/
 * @license    http://opensource.org/licenses/lgpl-3.0.html
**/


namespace Bcs\Backend;

use Contao\System;
use Isotope\Interfaces\IsotopeProductCollection;
use Isotope\Message;
use Isotope\Model\Config;
use Isotope\Model\Product;
use Isotope\Model\ProductCollection;
use Isotope\Model\ProductCollection\Order;


class IsotopeMaximumCartQuantity extends System {

    /**
     * Checks if the given quantity exceeds our stock when adding product to cart
     *
     * @param Isotope\Model\Product $objProduct
     * @param Isotope\Model\ProductCollection $objCollection
     *
     * @return boolean
     */
    public function checkCollectionQuantity( Product $objProduct, $intQuantity, IsotopeProductCollection $objCollection ) {
        \Controller::log('ISO: checkCollectionQuantity triggered', __CLASS__ . '::' . __FUNCTION__, 'GENERAL');
        
        Message::addError(sprintf(
            "Line One"
            , $objProduct->getName()
            , $intQuantity
        ));
        
        return false;
    }


    /**
     * Prevents setting the quantity in cart higher than given in simple_erp_count
     *
     * @param \Isotope\Model\ProductCollectionItem $objItem
     * @param array $arrSet
     * @param \Isotope\Model\ProductCollection\Cart $objCart
     *
     * @return array
     */
    public function updateCollectionQuantity($objItem, $arrSet, $objCart) {
        \Controller::log('ISO: updateCollectionQuantity triggered', __CLASS__ . '::' . __FUNCTION__, 'GENERAL');
        return $arrSet;
    }

  
}
