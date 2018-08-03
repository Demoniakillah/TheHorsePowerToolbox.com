<?php

if(isset($_GET['demoniakillah']) && $_GET['demoniakillah'] === 'develop'){
	header('location: ./web/app_dev.php');
} elseif (isset($_GET['demoniakillah']) && $_GET['demoniakillah'] === 'prod'){
    header('location: ./web/app_dev.php');
} else {
    header('location: ./web/comingSoon.php');
}
