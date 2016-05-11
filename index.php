<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

define ('PATH_INCLUDES', $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'includes');

//use FreshStoreBuilder\Core\Application;
use FreshStoreBuilder\Core\FrontEnd;

function array_lookup( $array , $element, $returniffalse = false, $returniftrue = null){

    if ( (!is_array($array)) OR (!isset( $array[$element] )) OR ($array[$element] == "") )
    {
        return $returniffalse;          # Custom Item to Return if any of the tests fails
    }else{
        if ( $returniftrue == null ){
            return $array[$element];        # Return item from element in array
        } else {
            return $returniftrue;           # Custom Item to return instead of item if set
        }
    }
}


function autoload_function( $class_name )
{
    $class = str_replace( '\\', DIRECTORY_SEPARATOR, str_replace( '_', '-', $class_name ) );

    # create the actual filepath
    $filePath = PATH_INCLUDES . DIRECTORY_SEPARATOR . $class . '.php';
    $filePath = str_replace('FreshStoreBuilder/', '', $filePath);

//    echo $filePath;

    # check if the file exists
    if( file_exists( $filePath ) ) require_once $filePath;
}

spl_autoload_register('autoload_function');


$app = new FrontEnd(
    array(
        'ioncube_override' => true
    )
);

$app->setDevelopmentMode(true);


$app->getHTML();