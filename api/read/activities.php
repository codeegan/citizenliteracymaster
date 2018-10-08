<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//includes
include_once '../objects/Activity.class.php';
include_once '../../config/Database.class.php';
include_once '../../config/Config.class.php';

//instantiate database and activity objects
$database = new Database();
$conf = new params();

//$db = $database->getConnection();
//$db = $database->getLocalConnection('localhost','ip47','3306','root','passwd123');
$db = $database->getConnection();

//initialise activity object
$activity = new Activity($db);

//query activities
$result = $activity->read();
$count = $result->rowCount();

//check if rows returned

if ($count > 0) {
    //activities array
    $activities_arr = array();
    $activities_arr["activities"] = array();
    //retrieve query results
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $activity_item = array(
            "activity" => $activity,
            "lesson" => $lesson,
            "grapheme => $grapheme",
            "activitytype" => $activitytype,
            "nextatctivity" => $nextactivity,
            "graphimage" => $conf->getUrl().$graphimage,
            "graphaudio" => $conf->getUrl().$graphaudio,
            "graphword" => $graphword
        );

        array_push($activities_arr["activities"], $activity_item);
    }
    echo json_encode($activities_arr,JSON_UNESCAPED_SLASHES);
}

else {
    echo json_encode( array("message" => "No activities found"));
}
