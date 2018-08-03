<?php
/**
 * Created by PhpStorm.
 * User: royglen
 * Date: 30/07/18
 * Time: 01:14
 */
require_once ('AbstractController.php');

class Home extends AbstractController
{
    public function index()
    {
        echo ('homepage');
    }
}