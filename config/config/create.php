<?php
// initialise tables used to create the JSON services
include_once 'db.class.php';

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

$database = new db();
$pdo = $database->getPdo();

echo 'creating activity table ...';

try {
    $pdo ->exec($activity_sql);
    echo 'Activity database created';
} catch (PDOException $exception) {
    echo 'Database error:' . $exception->getMessage() . ' in ' . $exception->getFile() . ':' . $exception->getLine();
}
