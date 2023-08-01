<?php

/*
 * Bright Cloud Studio's Isotope Maximum Cart Quantity
 * Copyright (C) 2023 Bright Cloud Studio
 *
 * @package    bright-cloud-studio/isotope-maximum-cart-quantity
 * @link       https://www.brightcloudstudio.com/
 * @license    http://opensource.org/licenses/lgpl-3.0.html
*/

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
        
        // Add a message to the log showing this hook was called
        //\Controller::log('ISO: checkCollectionQuantity triggered', __CLASS__ . '::' . __FUNCTION__, 'GENERAL');
        
        
        // find product in cart to check if the total quantity exceeds our stock
        $oInCart = null;
        $oInCart = $objCollection->getItemForProduct($objProduct);
        
        // if we have something in the cart, and that plus our requested quantity are above ten
         if( $oInCart && ($oInCart->quantity+$intQuantity) > 10 ) {
             
             Message::addError(sprintf(
                $GLOBALS['TL_LANG']['ERR']['truncatedQuantity']
                , $intQuantity
                , 999
            ));
            
            return 0;
             
         } else {
             return $intQuantity;
         }
    
        
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
        
        // Add message to log to show it triggered this hook
        //\Controller::log('ISO: updateCollectionQuantity triggered', __CLASS__ . '::' . __FUNCTION__, 'GENERAL');
        
        $objProduct = null;
        $objProduct = $objItem->getProduct();
        
        if($arrSet['quantity'] > 10)
            $arrSet['quantity'] = 10;
        
        return $arrSet;
    }

  
}
