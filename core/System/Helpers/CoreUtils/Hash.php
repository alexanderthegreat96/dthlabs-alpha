<?php
namespace LexSystems\Core\System\Helpers\CoreUtils;
class Hash
{

    // blowfish algo
    private static $algo = '$2a';
    // cost parameter
    private static $cost = '$10';

    // Creating hashing salt
    public static function unique_salt(){
        return substr( sha1(mt_rand()), 0, 22 );
    }

    /**
     * Generate password hash
     */
    public static function make(string $password = ''){
        return crypt( $password, self::$algo . self::$cost . '$' . self::unique_salt() );
    }

    /**
     * Compare password against a hash
     */
    public static function check($hash, $password){
        $full_salt = substr($hash, 0, 29);
        $new_hash = crypt($password, $full_salt);

        return ($hash == $new_hash);
    }
}