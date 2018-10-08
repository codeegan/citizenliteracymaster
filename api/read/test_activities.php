<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//includes
include_once '../objects/Activity.class.php';
include_once '../../config/Database.class.php';

//instantiate database and activity objects
$database = new Database();
$db = $database->getLocalConnection('local','ip47','3306','root','passwd123');


//initialise activity object
$activity = new Activity($db);

//query activities
$stmt = $activity->read();
$count = $stmt->rowCount();

//check if rows returned
if ($count > 0) {
    //activities array
    $activities_arr = array();
    $activities_arr["rows"] = array();
    //retrieve query results
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $activity_item = array(
            "lesson" => $lesson,
            "grapheme => $grapheme",
            "activityType" => $activityType,
            "nextActivity" => $nextActivity,
            "graphImage" => $graphImage,
            "graphAudio" => $graphAudio,
            "graphWord" => $graphWord
        );

        array_push($activities_arr["rows"], $activity_item);
    }
    echo json_encode($activities_arr);
} else {
    echo json_encode( array("message" => "No activities found"));
}