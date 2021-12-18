<?php
namespace DthLabs\Modules;
use LexSystems\Framework\Kernel\System;
class Register extends System
{
    protected $username;
    protected $password;
    protected $firstName;
    protected $lastName;
    protected $email;
    protected $address;
    protected $phoneNumber;
    protected $userRank;
    /**
     * @param string $username
     * @param string $password
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $address
     * @param string $phoneNumber
     * @param string $user_rank
     */
    public function __construct
    (
        string $username = '',
        string $password = '',
        string $firstName = '',
        string $lastName = '',
        string $email = '',
        string $address = '',
        string $phoneNumber = '',
        string $userRank = 'user',
        string $status = 'active'
    )
    {
        $this->username = $username;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
        $this->userRank = $userRank;
        $this->status = $status;
    }

    /**
     * @return array
     */

    public function createUser()
    {
        $cols =
            [
                'username',
                'password',
                'first_name',
                'last_name',
                'email',
                'address',
                'phone_number',
                'user_rank',
                'status',
                'created_at',
                'updated_at'
            ];

        $vals =
            [
                $this->username,
                $this->hashThisPassword($this->password),
                $this->firstName,
                $this->lastName,
                $this->email,
                $this->address,
                $this->phoneNumber,
                $this->userRank,
                $this->status,
                time(),
                time()
            ];

        try{
            $this->mysqli()->insertData('dth_auth_users',$cols,$vals);
        }
        catch (\Exception $e)
        {
            return $e->getMessage();
        }
    }
}