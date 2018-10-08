<?php
include_once '../config/Database.class.php';

$database = new Database('dev');
$db = $database->getLocalConnection('localhost','ip47','3306','admin','passwd123');

//returns all graphs in the database
$getGraphs = 'select grapheme,graphsound as sound,graphword as word, graphimage as image,graphaudio as audio,graphtype as type
 from grapheme';

//$stmt = $db->prepare($getGraphs);

//pass query string to the PDO and return a data set, error or message if nothing return
try {
//    $stmt->execute();
    $result = $db->exec($getGraphs);

    while ($row = $result->fetch()){
        echo $row['grapheme'] . ' : ' . $row['word'] . '<br>';
        echo $imageurl . '/' . $row['image'] . '<br>';
        echo $soundurl . '/' . $row['audio'] . '<br>';
        echo '----------------<br>';
    }
} catch (Exception $e) {
    $output = 'Unable to run SQL query: <br>' .
        $e -> getMessage() . ' in ' . $e -> getFile() . ':' . $e->getLine();
}
