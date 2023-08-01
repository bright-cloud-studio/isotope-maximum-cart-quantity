<?php

/*
 * Bright Cloud Studio's Isotope Maximum Cart Quantity
 * Copyright (C) 2023 Bright Cloud Studio
 *
 * @package    bright-cloud-studio/isotope-maximum-cart-quantity
 * @link       https://www.brightcloudstudio.com/
 * @license    http://opensource.org/licenses/lgpl-3.0.html
*/

/* Isotope Hooks */
$GLOBALS['ISO_HOOKS']['addProductToCollection'][] = array('Bcs\Backend\IsotopeMaximumCartQuantity', 'checkCollectionQuantity');
$GLOBALS['ISO_HOOKS']['updateItemInCollection'][] = array('Bcs\Backend\IsotopeMaximumCartQuantity', 'updateCollectionQuantity');
