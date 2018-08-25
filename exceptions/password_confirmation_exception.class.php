<?php

/*
 * Author: Japhet diaz
 * Date: 4/28/2018
 * Description: file of the password confirmation exception
 */
class PasswordConfirmationException extends Exception {
    public function getDetails() {
        $view = new UserController();
        $message = "Passwords entered do not match.";
        return $view->error($message);
        
    }
}
