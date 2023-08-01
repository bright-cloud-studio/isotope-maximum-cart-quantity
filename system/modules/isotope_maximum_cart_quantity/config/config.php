<?php

/* HOOKS */
$GLOBALS['ISO_HOOKS']['addProductToCollection'][] = array('Bcs\Backend\IsotopeMaximumCartQuantity', 'checkCollectionQuantity');
$GLOBALS['ISO_HOOKS']['updateItemInCollection'][] = array('Bcs\Backend\IsotopeMaximumCartQuantity', 'updateCollectionQuantity');
