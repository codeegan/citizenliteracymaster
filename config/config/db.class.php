<?php

class db
{

    private $dbhost; //$_SERVER['RDS_HOSTNAME'];
    private $dbport;//= $_SERVER['RDS_PORT'];
    private $dbname; // = $_SERVER['RDS_DB_NAME'];
    private $charset = 'utf8';
    private $dsn;
    private $localDsn;
    private $username;
    private $password;
    private $error = "no message yet";
    public $database;

    function __construct()
    {
        //configure the DSN connection details for the environment
        $this->setDbhost();
        $this->setDbport();
        $this->setDbname();
        $this->setUsername();
        $this->setPassword();
        $this->setDsn();
    }

    //used for testing the class with a local server
    private function setLocalDsn($host,$port,$name)
    {
        $this->localDsn = "mysql:host=$host;port=$port;dbname=$name;charset={$this->charset}";
    }


    private function setDsn()
    {
        $this->dsn = "mysql:host={$this->dbhost};port={$this->dbport};dbname={$this->dbname};charset={$this->charset}";
    }

    private function setDbhost()
    {
        $this->dbhost = $_SERVER['RDS_HOSTNAME'];
    }

    private function setDbname()
    {
        $this->dbname = $_SERVER['RDS_DB_NAME'];
    }

    public function getDsn()
    {
        return $this->dsn;
    }


    public function getLocalDsn()
    {
        return $this->localDsn;
    }


    private function setDbport()
    {
        $this->dbport = $_SERVER['RDS_PORT'];
    }

    private function setUsername()
    {
        $this->username = $_SERVER['RDS_USERNAME'];
    }

    private function setPassword()
    {
        $this->password = $_SERVER['RDS_PASSWORD'];
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    public function setError($msg)
    {
        $this->error = $msg;
    }

    //create the connection
    public function getPdo()
    {
        $this->database = null;
        try {
            $this->database = new PDO($this->dsn, $this->username, $this->password);
            return $this->database;
        } catch (PDOException $exception) {
            $this->setError("Connection error: " . $exception->getMessage() .
                $exception->getMessage() . ' in ' . $exception->getFile() . ':' . $exception->getLine()
            );
        }
    }

    public function getLocalPdo($host,$name,$port,$user,$pass)
    {
        $this->setLocalDsn($host,$port,$name);
        $this->database = null;
        try {
            $this->database = new PDO($this->localDsn, $user, $pass);
            return $this->database;
        } catch (PDOException $exception) {
            $this->setError("Connection error: " . $exception->getMessage() .
                $exception->getMessage() . ' in ' . $exception->getFile() . ':' . $exception->getLine()
            );
        }
        echo '<p>Created PDO connection</p>';
    }

}