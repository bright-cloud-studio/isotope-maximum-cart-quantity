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

    /* HOOK - Triggered when trying to add a product to the cart on a Product Reader page */
    public function checkCollectionQuantity( Product $objProduct, $intQuantity, IsotopeProductCollection $objCollection ) {
        
        // Reset our message log so we don't get stacking errors every time
        Message::reset();

        // Get our product from within this collection ("cart") so we can see what the quantity is
        $oInCart = null;
        $oInCart = $objCollection->getItemForProduct($objProduct);
        
        // If we got an item from the collection and the current quantity plus our requested addition exceeds the limit
         if( $oInCart && ($oInCart->quantity+$intQuantity) > 10 ) {
            
            // Show our Isotope message box with our "truncatedQuantity" message
            Message::addConfirmation($GLOBALS['TL_LANG']['MSC']['cartAtMaximum']);
            
            // return what the quantity ended up being
            return 0;
             
         } else {
             // this request to add more items wont go over the limit, return our requested quantity
             return $intQuantity;
         }
    
        // We're doing nothing so return false to continue on with other things
        return false;
    }


    /* HOOK - Triggered when trying to update our quantity on a Cart page */
    public function updateCollectionQuantity($objItem, $arrSet, $objCart) {
        
        // If our quantity exceeds the limit
        if($arrSet['quantity'] > 10) {
            
            // Set our new quantity to the limit
            $arrSet['quantity'] = 10;
        
            // Display our Isotope message explaining what went down
            Message::addConfirmation($GLOBALS['TL_LANG']['MSC']['cartAtMaximum']);
            
        }
            
        // Return our modified set
        return $arrSet;
    }
  
}
