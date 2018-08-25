<?php
/*
 * Author: Melanie Turner
 * Date: April 2, 2018
 * Name: index.php
 * Description: homepage of project website
 */
//load application settings
require_once ("application/config.php");

//load autoloader
require_once ("vendor/autoload.php");

//load the dispatcher that dissects a request URL
new Dispatcher();