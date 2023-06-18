<?php

class DBConfig
{
    private $credentials = [
        'dbhost' => 'localhost',
        'dbname' => 'sitescanx',
        'dbusername' => 'root',
        'dbpassword' => ''
    ];

    public function credentials()
    {
        return $this->credentials;
    }
}
?>
