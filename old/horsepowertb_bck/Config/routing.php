<?php
/**
 * Created by PhpStorm.
 * User: royglen
 * Date: 29/07/18
 * Time: 22:53
 */
$routes = array(
    '/index_dev.php' => array(
        'name' => 'homepage',
        'class' => 'Home',
        'file' => realpath( __DIR__ . '/../Controller') . '/Home.php'
    )
);