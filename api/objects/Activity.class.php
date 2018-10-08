<?php

class Activity
{

    private $conn;
//private $table_name

    private $activity;
    private $lesson;
    private $grapheme;
    private $activityType;
    private $nextActivity;
    private $graphImage;
    private $graphAudio;
    private $graphWord;
    private $result;

    public function __construct($db)
//        public function __construct($conn,$stmt)
    {
        $this->conn = $db;
//        $this->stmt = $stmt;
    }

    function read()
    {
        $query = '
            select act.activity,act.lesson,act.grapheme,act.activitytype,act.nextactivity
		            ,grph.graphimage,grph.graphaudio,grph.graphword
              from activity act
 		      join grapheme grph on  act.grapheme=grph.grapheme';

        //prepare the statement
//        $this->db->execute($this->stmt);

        //execute the query
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}

/*
 * $result = $pdo->query($getGraphs);

    while ($row = $result->fetch()){
        echo $row['grapheme'] . ' : ' . $row['word'] . '<br>';
        echo $imageurl . '/' . $row['image'] . '<br>';
        echo $soundurl . '/' . $row['audio'] . '<br>';
        echo '----------------<br>';
    }
 * *?
 */
