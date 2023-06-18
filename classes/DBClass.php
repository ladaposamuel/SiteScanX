<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../config/DBConfig.php');

//Database class to connect to database and fire queries
class DBClass
{
    public $classQuery;
    private $conn;
    private $statement;

    public $errno = '';
    public $error = '';

    // Connects to the database

    public function __construct()
    {
        // get DBConfig credentials
        $dbCredentials = new DBConfig();
        $credentials = $dbCredentials->credentials();

        // Connect to the database
        $this->conn = new mysqli(
            $credentials['dbhost'],
            $credentials['dbusername'],
            $credentials['dbpassword'],
            $credentials['dbname']
        );
    }


    // Executes a database query
    public function query( $query )
    {
        $this->classQuery = $query;
        return $this->conn->query( $query );
    }

    public function escapeString( $query )
    {
        return $this->conn->real_escape_string( $query );
    }

    // Get the data return int result
    public function numRows( $result )
    {
        if ($result instanceof mysqli_result) {
            return $result->num_rows;
        }
        return 0;
    }

    public function lastInsertedID()
    {
        return $this->conn->insert_id;
    }

    // Get query using assoc method
    public function fetchAssoc( $result )
    {
        return $result->fetch_assoc();
    }

    // Gets array of query results
    public function fetchArray( $result , $resultType = MYSQLI_ASSOC )
    {
        return $result->fetch_array( $resultType );
    }

    // Fetches all result rows as an associative array, a numeric array, or both
    public function fetchAll( $result , $resultType = MYSQLI_ASSOC )
    {
        return $result->fetch_all( $resultType );
    }

    // Get a result row as an enumerated array
    public function fetchRow( $result )
    {
        return $result->fetch_row();
    }

    // Free all MySQL result memory
    public function freeResult( $result )
    {
        if ($result instanceof mysqli_result) {
            $this->conn->free_result( $result );
        }
    }

    //Closes the database connection
    public function close()
    {
        $this->conn->close();
    }

    public function sql_error()
    {
        if( empty( $this->error ) )
        {
            $errno = $this->conn->errno;
            $error = $this->conn->error;
        }
        return $errno . ' : ' . $error;
    }

    public function prepare($sql, $params = array()) {
        $stmt = $this->conn->prepare($sql);

        if ($stmt !== false) {
            if (!empty($params)) {
                // Bind params to the statement
                $types = str_repeat('s', count($params)); // Assume all params are strings
                $stmt->bind_param($types, ...$params);
            }
            return $stmt; // Return the prepared statement object
        }

        // If prepare() failed, set errno and error properties
        $this->errno = $this->conn->errno;
        $this->error = $this->conn->error;
        return false;
    }

}
