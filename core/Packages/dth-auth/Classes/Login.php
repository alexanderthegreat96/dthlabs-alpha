<?php
namespace  DthLabs\Modules;
use LexSystems\Framework\Kernel\System;
class Login extends System
{
    protected $username;
    protected $password;

    /**
     * @param string $username
     * @param string $password
     */
    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return array|bool[]
     * @throws \Exception
     */
    public function login()
    {
        /**
         * Give access to
         * MySQL Connection
         */

        $con = $this->mysqli()->connect();
        $session = $this->session();

        /**
         * Escape the string
         * Prevent SQL Injection
         */

        $username = mysqli_real_escape_string($con,$this->username);
        $password = mysqli_real_escape_string($con,$this->password);

        /**
         * Start hashing the password
         */

        $password =  $this->hashThisPassword($password);

        $get_data = mysqli_query($con,
            "SELECT id,status,user_rank FROM users WHERE username='$username' AND password='$password' LIMIT 1");

        if (mysqli_num_rows($get_data) == 1)
        {
            $a = mysqli_fetch_assoc($get_data);


            if ($a["status"] == "active") {
                $user_id = $a["id"];
                $user_rank = $a["user_rank"];

                $sessionParams =
                    [
                        'user_id' => $user_id,
                        'user_rank' => $user_rank,
                        'logged_in' => true
                    ];

                $session->sendTheseToSession($sessionParams);

                return array
                (
                    "status" => true
                );
            }
            else
            {
                return array
                (
                    "status" => false,
                    "error" => "Error account has been banned."
                );
            }

        }
        else
        {
            return array(
                "status" => false,
                "error" => "Incorrect credentials."
            );
        }
    }
}
