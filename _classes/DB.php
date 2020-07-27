<?php

    class Db{

        private const HOST_NAME = 'localhost';
        private const DB_NAME = 'nestix';
        private const USER_NAME = 'root';
        private const PWD = '';

        private static $conn = null;
        /**
         * Method get connection from SQL 
         */
        public static function getConnect(){
            if(is_null(self::$conn)) // Test if the connection is not open
            {
                // We will try to get the connection with SQL and catch if get error
                try
                {
                    $connection = 'mysql:host='.self::HOST_NAME.';dbname='.self::DB_NAME; // Insere the data
                    self::$conn = new PDO($connection,self::USER_NAME,self::PWD,array(PDO::ATTR_PERSISTENT => true));  // Create new PDO instance
                    self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // PDO option for the connection
                } 
                catch (PDOException $e)
                {
                    $message = 'Error connection Database ' . $e->getMessage();
                    die($message);  
                }
               self::$conn->exec('SET CHARACTER SET UTF8'); 
            }
            return self::$conn;
        }


    }

?>