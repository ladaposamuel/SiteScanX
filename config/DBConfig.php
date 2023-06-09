<?php
class DBConfig
{
    var $credentials;

    function credentials()
    {
        // Database variables
        // Host name
        $credentials['dbhost'] = 'localhost';
        // Database name
        $credentials['dbname'] = 'sitescanx';
        // Username
        $credentials['dbusername'] = 'root';
        // Password
        $credentials['dbpassword'] = '';

        return $credentials;
    }
}
?>
