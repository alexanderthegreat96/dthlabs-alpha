<?php
namespace jabarihunt;

/********************************************************************************
 * Password Handler
 *
 * This class was developed to handle passwords for the application calling it.
 * There are three functions. create() creates and returns a new
 * salted & hashed password.  compare() compares a given password to
 * another (that must be created by this class) to see if they match.
 * isValid() checks a user's password to see if it meets some basic password
 * validation rules (rules can be easily altered for your use).
 *
 * There is no "recovery" method, as passwords should only be hashed. This
 * prevents any possibility of password encryption being cracked, as well as plain
 * text passwords being exposed.
 *
 * To prevent rainbow type attacks, passwords have a random salt. The same password
 * will result in two different hashes every single time. Basically, there should
 * be no rhyme or reason to returned hashed passwords.
 *
 * This class assumes you have already made sure the password has the minimum
 * number of characters you require. It will die if an empty password is entered!
 * To be certain, use the isValid() method BEFORE calling the create() method.
 *
 * The returned hash may vary in length! It recommended that DB tables have a
 * column length of 255 characters.
 *
 * @author Jabari J. Hunt <jabari@jabari.net>
 * @todo Implement way to pass rules to Password::isValid().
 ********************************************************************************/

final class Password
{
    /********************************************************************************
     * CREATE METHOD
     * @param string $password
     * @param int $algorithm
     * @param int $cost
     * @throws \Exception
     * @return string
     ********************************************************************************/

    public static function create($password, $algorithm = PASSWORD_DEFAULT, $cost = 10)
    {
        // SET VALID ALGORITHMS ARRAY

        $validAlgorithms = [PASSWORD_DEFAULT, PASSWORD_BCRYPT];
        if (defined('PASSWORD_ARGON2I')) {$validAlgorithms[] = PASSWORD_ARGON2I;}
        if (defined('PASSWORD_ARGON2ID')) {$validAlgorithms[] = PASSWORD_ARGON2ID;}

        // THROW EXCEPTIONS FOR INVALID DATA | RETURN HASHED PASSWORD

        if (empty($password) || !is_string((string) $password)) {throw new \Exception('Empty password passed to Password::create().');}
        if (empty($cost) || !is_int($cost) || $cost <= 3) {throw new \Exception('Invalid cost passed to Password::create().');}
        if (empty($algorithm) || !in_array($algorithm, $validAlgorithms)) {throw new \Exception('Invalid algorithm passed to Password::create().');}

        return password_hash($password, $algorithm, ['cost' => $cost]);
    }

    /********************************************************************************
     * COMPARE METHOD
     * @param string $password
     * @param string $hash
     * @throws \Exception
     * @return boolean
     ********************************************************************************/

    public static function compare($password, $hash)
    {
        // THROW EXCEPTIONS FOR INVALID DATA | RETURN IF PASSWORD IS VALID

        if (empty($password)) {throw new \Exception('Invalid password passed to Password::compare().');}
        if (empty($hash)) {throw new \Exception('Invalid hash passed to Password::compare().');}

        return password_verify($password, $hash);
    }

    /********************************************************************************
     * IS VALID METHOD
     * @param string $password
     * @param string $username
     * @return boolean
     ********************************************************************************/

    public static function isValid($password, $username = NULL)
    {
        // SET INITIAL RETURN VARIABLE | TEST PASSWORD VALIDITY

        $passwordIsValid = FALSE;

        if
        (
            !empty($password) &&                     // NOT EMPTY
            strlen($password) >= 8 &&                // AT LEAST EIGHT CHARACTERS
            preg_match('(\p{Lu})u', $password) &&    // CONTAINS ONE UPPERCASE CHAR
            preg_match('(\p{Ll})u', $password) &&    // CONTAINS ONE LOWERCASE CHAR
            preg_match('(\p{N})u', $password) &&     // CONTAINS ONE NUMBER
            (                                        // CONTAINS ONE SYMBOL
                preg_match('(\p{S})u', $password) ||
                preg_match('(\p{P})u', $password)
            )
        )
        {
            // IF USERNAME WAS PASSED, MAKE SURE IT ISN'T IN THE PASSWORD

            if ($username == NULL) {$passwordIsValid = TRUE;}
            else if (strpos(strtolower($password), strtolower($username)) === FALSE) {$passwordIsValid = TRUE;}
        }

        // RETURN RESULT

        return $passwordIsValid;
    }
}

?>