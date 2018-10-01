<?php
// initialise tables used to create the JSON services
include_once 'db.class.php';

//activity table used to store information related to each activity for the UI
$activity_data = '
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
truncate table activity;
INSERT INTO `activity` (`lesson`, `activity`, `activitytype`, `grapheme`, `lessontext`, `nextactivity`, `previousactivity`) VALUES
	(\'satpin\', \'write_n\', \'write\', \'n\', \'\\N\', \'\', \'write_i\'),
	(\'satpin\', \'write_s\', \'write\', \'s\', \'\\N\', \'write_a\', \'\\N\'),
	(\'satpin\', \'write_p\', \'write\', \'p\', \'\\N\', \'write_i\', \'write_t\'),
	(\'satpin\', \'write_i\', \'write\', \'i\', \'\\N\', \'write_n\', \'write_p\'),
	(\'satpin\', \'write_t\', \'write\', \'t\', \'\\N\', \'write_p\', \'write_a\'),
	(\'satpin\', \'write_a\', \'write\', \'a\', \'\\N\', \'write_t\', \'write_s\'),
	(\'satpin\', \'voice_n\', \'voice\', \'n\', \'\\N\', \'\', \'voice_i\'),
	(\'satpin\', \'voice_s\', \'voice\', \'s\', \'\\N\', \'voice_a\', \'\\N\'),
	(\'satpin\', \'voice_p\', \'voice\', \'p\', \'\\N\', \'voice_i\', \'voice_t\'),
	(\'satpin\', \'voice_i\', \'voice\', \'i\', \'\\N\', \'voice_n\', \'voice_p\'),
	(\'satpin\', \'voice_t\', \'voice\', \'t\', \'\\N\', \'voice_p\', \'voice_a\'),
	(\'satpin\', \'voice_a\', \'voice\', \'a\', \'\\N\', \'voice_t\', \'voice_s\');
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;';

//app config table used to config parameters such as the S3 root folder location
$appconfig_data = '
/*!40000 ALTER TABLE `appconfig` DISABLE KEYS */;
truncate table appconfig;
INSERT INTO `appconfig` (`imageurl`, `soundurl`) VALUES
	(\'https://s3.us-east-2.amazonaws.com/ip47media/\', \'https://s3.us-east-2.amazonaws.com/ip47media/\');
/*!40000 ALTER TABLE `appconfig` ENABLE KEYS */;
';

$grapheme_data = '
/*!40000 ALTER TABLE `grapheme` DISABLE KEYS */;
truncate table grapheme;
INSERT INTO `grapheme` (`grapheme`, `graphsound`, `graphword`, `graphimage`, `graphaudio`, `graphtype`) VALUES
	(\'s\', \'s\', \'salad\', \'salad.png\', \'s.mp3\', \'grapheme\'),
	(\'a\', \'a\', \'arm\', \'arm.png\', \'a.mp3\', \'grapheme\'),
	(\'t\', \'t\', \'tattoo\', \'tattoo.png\', \'t.mp3\', \'grapheme\'),
	(\'p\', \'p\', \'pen\', \'pen.png\', \'p.mp3\', \'grapheme\'),
	(\'i\', \'i\', \'inch\', \'inch.png\', \'i.mp3\', \'grapheme\'),
	(\'n\', \'n\', \'numbers\', \'numbers.png\', \'n.mp3\', \'grapheme\');
/*!40000 ALTER TABLE `grapheme` ENABLE KEYS */;
';

$lesson_sql = '
/*!40000 ALTER TABLE `lesson` DISABLE KEYS */;
truncate table lesson;
INSERT INTO `lesson` (`lessonname`, `lessontype`) VALUES
	(\'satpin\', NULL);
/*!40000 ALTER TABLE `lesson` ENABLE KEYS */;
';

$pratice_sql = '
/*!40000 ALTER TABLE `practice` DISABLE KEYS */;
truncate table practice;
INSERT INTO `practice` (`lesson`, `activity`, `possibleanswer`, `correctanswer`) VALUES
	(\'satpin\', \'sound\', \'s\', \'c,s,z\'),
	(\'satpin\', \'sound\', \'a\', \'a,i,u\'),
	(\'satpin\', \'sound\', \'t\', \'t,th,j\'),
	(\'satpin\', \'sound\', \'p\', \'p,ph,k\'),
	(\'satpin\', \'sound\', \'i\', \'i,e,y\'),
	(\'satpin\', \'sound\', \'n\', \'n,m,w\');
/*!40000 ALTER TABLE `practice` ENABLE KEYS */;
';

$database = new db();
$pdo = $database->getPdo();

echo '<p>Truncating tables and inserting data ...</p>';

try {
    //initialise all the database tables
    $pdo ->exec($activity_data);
    echo '<p>activity data added ...</p>';

    $pdo ->exec($appconfig_sql);
    echo '<p>appconfig data added ...</p>';

    $pdo ->exec($activity_sql);
    echo '<p>grapheme data added ...</p>';

    $pdo ->exec($lesson_sql);
    echo '<p>lesson data added ...</p>';

    $pdo ->exec($pratice_sql);
    echo '<p>practice data added ...</p>';
} catch (PDOException $exception) {
    echo 'Database error:' . $exception->getMessage() . ' in ' . $exception->getFile() . ':' . $exception->getLine();
}
