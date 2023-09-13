<?php
    
    /**
    * Bright Cloud Studio's Isotope Maximum Cart Quantity
    *
    * Copyright (C) 2023 Bright Cloud Studio
    *
    * @package    bright-cloud-studio/isotope-maximum-cart-quantity
    * @link       https://www.brightcloudstudio.com/
    * @license    http://opensource.org/licenses/lgpl-3.0.html
    **/
    
    /* Extend the tl_user palettes */
    $GLOBALS['TL_DCA']['tl_iso_config']['palettes']['default'] = str_replace('{analytics_legend}', '{maximum_cart_quantity_legend},maxCartQuantity,maxCartMessage,typeOfLimit;{analytics_legend}', $GLOBALS['TL_DCA']['tl_iso_config']['palettes']['default']);
    
    $GLOBALS['TL_DCA']['tl_iso_config']['fields']['maxCartQuantity'] = array
    (
        'label'                 => &$GLOBALS['TL_LANG']['tl_iso_config']['maxCartQuantity'],
        'inputType'             => 'text',
        'eval'                  => array('mandatory'=>false, 'maxlength'=>10, 'tl_class'=>'w50'),
        'sql'                   => "varchar(10) NOT NULL default ''",
    );
    
    $GLOBALS['TL_DCA']['tl_iso_config']['fields']['maxCartMessage'] = array
    (
        'label'                 => &$GLOBALS['TL_LANG']['tl_iso_config']['maxCartMessage'],
        'inputType'             => 'text',
        'eval'                  => array('maxlength'=>255, 'tl_class'=>'w50'),
        'sql'                   => "varchar(255) NOT NULL default ''",
    );
    
    $GLOBALS['TL_DCA']['tl_iso_config']['fields']['typeOfLimit'] = array
    (
        'label'                 => &$GLOBALS['TL_LANG']['tl_iso_config']['typeOfLimit'],
        'inputType'             => 'radio',
        'options'               => array('individual' => 'Limit individual product quantity', 'combined' => 'Limit total cart quantity'),
        'eval'                  => array('mandatory'=>true, 'tl_class'=>'w50'),
        'default'               => 'true',
        'sql'                   => "varchar(32) NOT NULL default ''"
    );

?>
