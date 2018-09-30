<?php

class db
{

    private $dbhost = 'localhost'; //$_SERVER['RDS_HOSTNAME'];
    private $dbport = '3306';//= $_SERVER['RDS_PORT'];
    private $dbname = 'ip47'; // = $_SERVER['RDS_DB_NAME'];
    private $charset = 'utf8';
    public $testdsn;
    private $dsn;
    private $username = 'ip47admin';
    private $password = 'ip47admin';
    private $error = "no message yet";
    public $database;

    function __construct(){
        //configure the DSN connection details for the environment
        $this->setDbhost();
        $this->setDbport();
        $this->setDbname();
        $this->setUsername();
        $this->setPassword();
        $this->setTestDsn();
    }

    private function setDsn()
    {
        $this->dsn = "mysql:host={$this->dbhost};port={$this->dbport};dbname={$this->dbname};charset={$this->charset}";
    }

    private function setTestDsn()
    {
        $this->testdsn = "mysql:host={$this->dbhost};port={$this->dbport};dbname={$this->dbname};charset={$this->charset}";
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


    public function getTestDsn()
    {
        return $this->testdsn;
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

    /**
     * @return mixed
     */
    public function setError($msg)
    {
        $this->error = $msg;
    }

    //create the connection
    public function getPdoConnection()
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

}