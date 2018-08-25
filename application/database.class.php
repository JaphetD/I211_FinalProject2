<?php

/*
 * Author: Melanie Turner
 * Date: April 7, 2018
 * File: database,class.php
 * Description: Description: the Database class sets the database details.
 * 
 */

class Database {

    //define database parameters
    private $param = array(
        'host' => 'localhost',
        'login' => 'phpuser',
        'password' => 'phpuser',
        'database' => 'i211_finalproject',
        'tblMovie' => 'movies',
        'tblBook' => 'books',
        'tblMusic' => 'musics',
        'tblMovieRating' => 'movie_ratings',
        'tblBookCategory' => 'book_categories',
        'tblMusicType' => 'music_types',
        'tblUser' => 'users'
    );
    //define the database connection object
    private $objDBConnection = NULL;
    static private $_instance = NULL;

    //constructor
    private function __construct() {
        $this->objDBConnection = @new mysqli(
                $this->param['host'], $this->param['login'], $this->param['password'], $this->param['database']
        );
        if (mysqli_connect_errno() != 0) {
            $message = "Connecting database failed: " . mysqli_connect_error() . ".";
            include 'error.php';
            exit();
        }
    }

    //static method to ensure there is just one Database instance
    static public function getDatabase() {
        if (self::$_instance == NULL)
            self::$_instance = new Database();
        return self::$_instance;
    }

    //this function returns the database connection object
    public function getConnection() {
        return $this->objDBConnection;
    }

    //returns the name of the table that stores movies
    public function getMovieTable() {
        return $this->param['tblMovie'];
    }

    //returns the name of the table that stores books
    public function getBookTable() {
        return $this->param['tblBook'];
    }

    //returns the name of the table storing sheet music
    public function getMusicTable() {
        return $this->param['tblMusic'];
    }

    //returns the name of the table storing movie ratings
    public function getMovieRatingTable() {
        return $this->param['tblMovieRating'];
    }

    //return the name of the table that stores book categories
    public function getBookCategoryTable() {
        return $this->param['tblBookCategory'];
    }
    
    //return the name of the table that stores book categories
    public function getMusicTypeTable() {
        return $this->param['tblMusicType'];
    }
    
    //return the name of the table that stores user account info
    public function getUserTable() {
        return $this->param['tblUser'];
    }

}
