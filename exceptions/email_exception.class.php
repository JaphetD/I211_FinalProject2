<?php

/*
 * Author: Japhet diaz
 * Date: 4/28/2018
 * Description: file of the email exception
 */
class EmailException extends Exception{
    public function getDetails() {
        $view = new UserController();
        $message = "Email invalid. Try again with a valid email address.";
        return $view->error($message);
        
    }
}
