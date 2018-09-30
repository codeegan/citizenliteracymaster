<?php
/**
 * Created by PhpStorm.
 * User: Jamesn73
 * Date: 2018/09/30
 * Time: 15:39
 */

include_once 'db.class.php';

$database = new db();

echo $database->testdsn;
echo '<br>';
echo $database->getDsn();


//include __DIR__ . '/templates/output.html.php';