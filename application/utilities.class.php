<?php

/* Author: Melanie Turner
 * Date: 4/28/2018
 * Name: utilities.class.php
 * Description: this class is used to validate the email address and date.
 */

class Utilities {
    //validate an email address. An valid email address appears in the format of "username@domain.domain"
    public static function checkemail($email) {
        $result = TRUE;
        if (!preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $email)) {
            $result = FALSE;
        }
        return $result;
    }

//validate that the password can be confirmed a second time
    public static function validatepassword($password, $confirm_password) {
        if ($password != $confirm_password){
             return FALSE;
        } elseif ($password == $confirm_password){
            return TRUE;
        }

    }
}
