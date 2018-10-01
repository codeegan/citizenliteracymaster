<?php
// initialise tables used to create the JSON services
include_once 'db.class.php';

//activity table used to store information related to each activity for the UI
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

//app config table used to config parameters such as the S3 root folder location
$appconfig_sql = '
DROP TABLE IF EXISTS `appconfig`;
CREATE TABLE IF NOT EXISTS `appconfig` (
`imageurl` varchar(50) DEFAULT NULL,
  `soundurl` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8
';

$grapheme_sql = '
DROP TABLE IF EXISTS `grapheme`;
CREATE TABLE IF NOT EXISTS `grapheme` (
`grapheme` tinytext NOT NULL,
  `graphsound` varchar(100) DEFAULT NULL,
  `graphword` varchar(50) DEFAULT NULL,
  `graphimage` varchar(100) DEFAULT NULL,
  `graphaudio` varchar(100) DEFAULT NULL,
  `graphtype` tinytext DEFAULT NULL,
  KEY `grapheme_i1` (`grapheme`(100))
) ENGINE=InnoDB DEFAULT CHARSET=utf8
';

$lesson_sql = '
DROP TABLE IF EXISTS `lesson`;
CREATE TABLE IF NOT EXISTS `lesson` (
  `lessonname` varchar(50) NOT NULL,
  `lessontype` tinytext DEFAULT NULL,
  KEY `lesson_i1` (`lessonname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8';

$pratice_sql = '
DROP TABLE IF EXISTS `practice`;
CREATE TABLE IF NOT EXISTS `practice` (
  `lesson` varchar(50) DEFAULT NULL,
  `activity` varchar(50) DEFAULT NULL,
  `possibleanswer` text DEFAULT NULL,
  `correctanswer` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8';

$database = new db();
$pdo = $database->getPdo();

echo 'creating activity table ...';

try {
    //initialise all the database tables
    $pdo ->exec($activity_sql);
    echo '<p>activity database created</p>';

    $pdo ->exec($appconfig_sql);
    echo '<p>appconfig database created</p>';

    $pdo ->exec($activity_sql);
    echo '<p>grapheme database created</p>';

    $pdo ->exec($lesson_sql);
    echo '<p>lesson database created</p>';

    $pdo ->exec($pratice_sql);
    echo '<p>practice database created</p>';
} catch (PDOException $exception) {
    echo 'Database error:' . $exception->getMessage() . ' in ' . $exception->getFile() . ':' . $exception->getLine();
}
