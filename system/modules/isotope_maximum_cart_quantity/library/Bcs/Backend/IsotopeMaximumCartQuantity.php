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
use Isotope\Isotope;
use Isotope\Interfaces\IsotopeProductCollection;
use Isotope\Message;
use Isotope\Model\Config;
use Isotope\Model\Product;
use Isotope\Model\ProductCollection;
use Isotope\Model\ProductCollection\Cart;
use Isotope\Model\ProductCollection\Order;



class IsotopeMaximumCartQuantity extends System {

    
    /* HOOK - Triggered when trying to add a product to the cart on a Product Reader page */
    public function checkCollectionQuantity( Product $objProduct, $intQuantity, IsotopeProductCollection $objCollection ) {
        
        // Get the maximum quantity number from our store config
        $objConfig = Isotope::getConfig();
        $quantity = $objConfig->maxCartQuantity;
        
        // Reset our message log so we don't get stacking errors every time
        Message::reset();
        
        
        
        
        
        //foreach($objCollection->getItems() as $prod) {
        //    print_r($prod);
        //}
        //die();

        
        switch ($objConfig->typeOfLimit) {
            case "individual":
                
                // Get our product from within this collection ("cart") so we can see what the quantity is
                $oInCart = null;
                $oInCart = $objCollection->getItemForProduct($objProduct);
                
                // If our cart has this product already and it is at the maximum limit
                if($oInCart && $oInCart->quantity == $quantity ) {
                    // Show our "Your at the limit" message and do nothing
                    Message::addConfirmation($objConfig->maxCartMessage);
                    return false;
                }
                
                // If our cart has this product and our requested increase would go over the limit
                else if( $oInCart && ($oInCart->quantity+$intQuantity) > $quantity ) {
                    
                    // find out how many could actually get added
                    $allowableQuantity = $quantity - $oInCart->quantity;
                    return $allowableQuantity;
                
                }
                
                // If this product isnt already in our cart
                else {
                    // limit our requested quantity to the maximum
                    if($intQuantity > $quantity)
                        $intQuantity = $quantity;
                        
                    return $intQuantity;
                }
                
                return;
                break;
                
            case "combined":
                echo "Your favorite color is blue!";
                break;
            default:
                return false;
        }
        
        
    }
    
    
    /* HOOK - Triggered when trying to update our quantity on a Cart page */
    public function updateCollectionQuantity($objItem, $arrSet, $objCart) {
        
        // The maximum quantity allowed in the cart at one time;
        $objConfig = Isotope::getConfig();
        $quantity = $objConfig->maxCartQuantity;
        
        switch ($objConfig->typeOfLimit) {
            case "individual":
                
                // Set our requested quantity to the limit if it exceeds it
                if($arrSet['quantity'] > $quantity) {
                    $arrSet['quantity'] = $quantity;
                    
                    // Display our Isotope message explaining what went down
                    Message::addConfirmation($objConfig->maxCartMessage);
                }
                
                break;
            case "combined":
                echo "Your favorite color is blue!";
                break;
        }
        
        // Return our modified set
        return $arrSet;
    }

    
    /* HOOK - Triggered when two carts have merged together (when a guest logs in while having items in their cart, while their account already had a cart attached to it */
    public function mergeCollections(IsotopeProductCollection $oldCollection, IsotopeProductCollection $newCollection)
    {
        // The maximum quantity allowed in the cart at one time;
        $objConfig = Isotope::getConfig();
        $quantity = $objConfig->maxCartQuantity;
        
        switch ($objConfig->typeOfLimit) {
            case "individual":
                
                // If we have an old cart and a new cart
                if ($oldCollection instanceof Cart && $newCollection instanceof Cart) {
                    
                    // Loop through all of the items in our new cart
                    foreach($newCollection->getItems() as $oItem) {
                        // Limit the quantity
                        if($oItem->quantity > $quantity)
                            $oItem->quantity = $quantity;
                    }
        
                    // Save our modifications
                    $newCollection->save();
                }
                
                break;
            case "combined":
                echo "Your favorite color is blue!";
                break;
        }
        
    }

}
