<?php
// test that you can access the lccal server and create a table
include_once 'db.class.php';

echo '<p>instantiating db</p>';
$database = new db();

echo '<br>getting dsn';

$pdo = $database->getLocalPdo('localhost','ip47','3306','root','passwd123');

echo '<br>';
echo $database->getLocalDsn();

//include __DIR__ . '/templates/output.html.php';

$activity_sql = '
DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
  `lesson` varchar(50) NOT NULL,
  `activity` varchar(50) NOT NULL,
  `activitytype` tinytext DEFAULT NULL,
  `grapheme` tinytext DEFAULT NULL,
  `lessontext` varchar(50) DEFAULT NULL,
  `nextactivity` tinytext DEFAULT NULL,
  `previousactivity` tinytext DEFAULT NULL,
  KEY `activity_i1` (`activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8';


echo 'creating activity table ...';

try {
    $pdo ->exec($activity_sql);
    echo 'Activity database created';
} catch (PDOException $exception) {
    echo 'Database error:' . $exception->getMessage() . ' in ' . $exception->getFile() . ':' . $exception->getLine();
}