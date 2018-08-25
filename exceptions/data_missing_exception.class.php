<?php

/*
 * Author: Japhet diaz
 * Date: 4/28/2018
 * Description: file of the data missing exception
 */
class DataMissingException extends Exception{
    //put your code here
    public function getDetails() {
        $view = new UserController();
        $message = "All fields are required.";
        return $view->error($message);
        
    }
}
?>
