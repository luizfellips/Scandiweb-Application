<?php
 include("config.php");
class Connection
{
    private static $connection;

    private function __construct(){}

    public static function getConnection() {

        $dsn = 'mysql:host=localhost;dbname='.DB_NAME.';';

        try {
            if(!isset($connection)){
                $connection =  new \PDO($dsn, DB_USER, DB_PASSWORD);
                $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }
            return $connection;
         } 
         catch (\PDOException $e) {
            $message .= "\nError: " . $e->getMessage();
            throw new \Exception($message);
         }
     }
}
