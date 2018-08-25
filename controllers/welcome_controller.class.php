<?php
/*
 * Author: Melanie Turner
 * Date: 4/17/2018
 * File: welcome_controller.class.php
 * Description: the welcome controller; this is the default controller.
 * 
 */

class WelcomeController {
    //put your code here
    public function index() {
        $view = new WelcomeIndex();
        $view->display();
    }
}