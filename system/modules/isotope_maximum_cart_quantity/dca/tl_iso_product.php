<?php

/**
 * Bright Cloud Studio's Isotope Color Selector
 *
 * Copyright (C) 2022 Bright Cloud Studio
 *
 * @package    bright-cloud-studio/isotope-color-selector
 * @link       https://www.brightcloudstudio.com/
 * @license    http://opensource.org/licenses/lgpl-3.0.html
**/

 /* Extend the tl_user palettes */
 $GLOBALS['TL_DCA']['tl_iso_product']['palettes']['default'] = str_replace('{publish_legend}', '{maximum_cart_quantity_legend},limit;{publish_legend}', $GLOBALS['TL_DCA']['tl_iso_product']['palettes']['default']);


/* Add fields to tl_iso_product */
$GLOBALS['TL_DCA']['tl_iso_product']['fields']['limit'] = array
(
  'label'                   => &$GLOBALS['TL_LANG']['tl_iso_attribute_option']['color_css'],
  'inputType'               => 'text',
  'default'                 => '0',
  'search'                  => true,
  'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50'),
  'sql'                     => "varchar(255) NOT NULL default ''",
);

?>
