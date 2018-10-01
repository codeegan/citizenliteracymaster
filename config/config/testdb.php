<?php
// Test that the database returns the correct dsn on the AWS server

echo '<p>hallo</p>';

include_once 'db.class.php';

echo '<br>instantiating db';
$database = new db();

echo '<br>getting dsn';

echo $database->setLocalDsn();
echo '<br>';
echo $database->getDsn();


//include __DIR__ . '/templates/output.html.php';