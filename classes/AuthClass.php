<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/DBClass.php');
include_once($filepath . '/Session.php');
include_once($filepath . '/../includes/_helpers.php');

Session::init();

class AuthClass
{

    private $db;

    public function __construct()
    {
        $this->db = new DBClass();

    }


    /**
     * Handles user login
     * @param $email
     * @param $password
     * @return array
     */
    public function login($email, $password)
    {
        $rawEmail = cleanString($email);
        $rawPassword = cleanString($password);


        $email = $this->db->escapeString($rawEmail);
        $password = $this->db->escapeString($rawPassword);
        $password = md5($password . 'hello_world');

        if (!$email || !$password) {
            return [
                'status' => false,
                'message' => 'Please enter your email and password to login'
            ];
        }

        try {
            $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
            $result = $this->db->query($query);

        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => $this->db->sql_error(),
                'status_code' => 500
            ];
        }

        if ($this->db->numRows($result) === 1) {
            $row = $this->db->fetchAssoc($result);

            if ($row['user_status'] === 'inactive') {
                return [
                    'status' => false,
                    'message' => 'Your account is inactive. Please contact the admin.',
                    'status_code' => 401
                ];
            }

            Session::set("adminLogin", true);
            Session::set("adminInfo", [
                'id' => $row['id'],
                'name' => $row['firstname'] . ' ' . $row['lastname'],
                'email' => $row['email'],
                'user_status' => $row['user_status'],
                'user_type' => $row['user_type'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            ]);

            return [
                'status' => true,
                'message' => 'Sign-in Successful',
                'status_code' => 200
            ];

        } else {
            return [
                'status' => false,
                'message' => 'Unable to Sign-in, please check your email and password.',
                'status_code' => 400
            ];
        }
    }


    /**
     * Handles user logout
     * @return null
     */
    public function logout()
    {

        Session::destroy();

        return [
            'status' => true,
            'message' => 'Sign-out successful!',
            'status_code' => 200
        ];
    }


}

?>
