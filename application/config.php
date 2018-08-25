<?php

/*
 * Author: Melanie Turner and Enrico Banks
 * Date: 4/17/2018
 * File: config.php
 * Description: set application settings
 * 
 */

//error reporting level: 0 to turn off all error reporting; E_ALL to report all
error_reporting(E_ALL);

//local time zone
date_default_timezone_set('America/New_York');

//base url of the application
define("BASE_URL", "http://localhost/I211_FinalProject2");

/*************************************************************************************
 *                       settings for movies                                         *
 ************************************************************************************/

//define default path for media images
define("MOVIE_IMG", "www/img/movies/");


/*************************************************************************************
 *                       settings for books                                         *
 ************************************************************************************/

//define default path for media images
define("BOOK_IMG", "www/img/books/");


/*************************************************************************************
 *                       settings for music sheets                                  *
 ************************************************************************************/

//define default path for media images
define("MUSIC_IMG", "www/img/musics/");