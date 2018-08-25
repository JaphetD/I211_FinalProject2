<?php

/*
 * Author: Enrico Banks
 * Date: 4/27/2018
 * File: music_model.class.php
 * Description: the music model
 * 
 */

class MusicModel {

    //private data members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblMusic;
    private $tblMusicType;

    //To use singleton pattern, this constructor is made private. To get an instance of the class, the getMovieModel method must be called.
    private function __construct() {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblMusic = $this->db->getMusicTable();
        $this->tblMusicType = $this->db->getMusicTypeTable();

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars. 
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars 
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        //initialize music ratings
        if (!isset($_SESSION['music_types'])) {
            $types = $this->get_music_types();
            $_SESSION['music_types'] = $types;
        }
    }

    //static method to ensure there is just one MovieModel instance
    public static function getMusicModel() {
        if (self::$_instance == NULL) {
            self::$_instance = new MusicModel();
        }
        return self::$_instance;
    }

    /*
     * the list_music method retrieves all music from the database and
     * returns an array of Movie objects if successful or false if failed.
     * Movies should also be filtered by ratings and/or sorted by titles or rating if they are available.
     */

    public function list_music() {
        /* construct the sql SELECT statement in this format
         * SELECT ...
         * FROM ...
         * WHERE ...
         */
        
       $sql = "SELECT * FROM " . $this->tblMusic . "," . $this->tblMusicType .
               " WHERE " . $this->tblMusic . ".type=" . $this->tblMusicType . ".type_id";

         // $sql = "SELECT * FROM " . $this->tblMusic;
        
         
        //execute the query
       
        $query = $this->dbConnection->query($sql);
         

        // if the query failed, return false. 
        if (!$query)
            return false;

        //if the query succeeded, but no music was found.
        if ($query->num_rows == 0)
            return 0;

        //handle the result
        //create an array to store all returned music
        $musics = array();

        //loop through all rows in the returned recordsets
        while ($obj = $query->fetch_object()) {
            $music = new Music(stripslashes($obj->title), stripslashes($obj->composer), stripslashes($obj->type), stripslashes($obj->image), stripslashes($obj->summary));

            //set the id for the music
            $music->setId($obj->id);

            //add the music into the array
            $musics[] = $music;
        }
        return $musics;
    }

    public function view_music($id) {
        //the select ssql statement
       $sql = "SELECT * FROM " . $this->tblMusic . "," . $this->tblMusicType .
                " WHERE " . $this->tblMusic . ".type=" . $this->tblMusicType . ".type_id" .
                " AND " . $this->tblMusic . ".id='$id'";

        //execute the query
        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            $obj = $query->fetch_object();
            
            //create a music object
            $music = new Music(stripslashes($obj->title), stripslashes($obj->composer), stripslashes($obj->type),stripslashes($obj->image), stripslashes($obj->summary));

            //set the id for the music
            $music->setId($obj->id);

            return $music;
        }

        return false;
    }

    //the update_music method updates an existing music in the database. Details of the music are posted in a form. Return true if succeed; false otherwise.
    public function update_music($id) {
        //if the script did not received post data, display an error message and then terminite the script immediately
        if (!filter_has_var(INPUT_POST, 'title') ||
                !filter_has_var(INPUT_POST, 'composer') ||
                !filter_has_var(INPUT_POST, 'type') ||
                !filter_has_var(INPUT_POST, 'image') ||
                !filter_has_var(INPUT_POST, 'summary')) {

            return false;
        }

        //retrieve data for the new music; data are sanitized and escaped for security.
        $title = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING)));
        $composer = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'composer', FILTER_SANITIZE_STRING)));
        $type = $this->dbConnection->real_escape_string(filter_input(INPUT_POST, 'type', FILTER_DEFAULT));
        $image = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));
        $summary = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'summary', FILTER_SANITIZE_STRING)));

        //query string for update 
        $sql = "UPDATE " . $this->tblMusic .
                " SET title='$title', composer='$composer', type='$type',
               image='$image', summary='$summary' WHERE id='$id'";

        //execute the query
        return $this->dbConnection->query($sql);
    }

    //search the database for music that match words in titles. Return an array of music if succeed; false otherwise.
    public function search_music($terms) {
       $terms = explode(" ", $terms); //explode multiple terms into an array
        //select statement for AND serach
        $sql = "SELECT * FROM " . $this->tblMusic . "," . $this->tblMusicType .
                " WHERE " . $this->tblMusic . ".type=" . $this->tblMusicType . ".type_id AND (1";

        foreach ($terms as $term) {
            $sql .= " AND title LIKE '%" . $term . "%'";
        }

        $sql .= ")";
        
        //execute the query
        $query = $this->dbConnection->query($sql);
         
        // the search failed, return false. 
        if (!$query)
            return false;
        
        //search succeeded, but no music was found.
        if ($query->num_rows == 0)
            return 0;
        
        //search succeeded, and found at least 1 music found.
        //create an array to store all the returned music
        $musics = array();
        
        //loop through all rows in the returned recordsets
        while ($obj = $query->fetch_object()) {
            $music = new Music($obj->title, $obj->composer, $obj->type, $obj->image, $obj->summary);

            //set the id for the music
            $music->setId($obj->id);

            //add the music into the array
            $musics[] = $music;
        }
        return $musics;
    }
    
    //add new music to the music database
    public function create_music() {
        //if the script did not received post data, display an error message and then terminite the script immediately
        if (!filter_has_var(INPUT_POST, 'title') ||
                !filter_has_var(INPUT_POST, 'composer') ||
                !filter_has_var(INPUT_POST, 'type') ||
                !filter_has_var(INPUT_POST, 'image') ||
                !filter_has_var(INPUT_POST, 'summary')) {

            return false;
        }

        //retrieve data for the new music; data are sanitized and escaped for security.
        $title = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING)));
        $composer = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'composer', FILTER_SANITIZE_STRING)));
        $type = $this->dbConnection->real_escape_string(filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT));
        $image = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));
        $summary = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'summary', FILTER_SANITIZE_STRING)));

        //query string for update 
        $sql = "INSERT INTO " . $this->tblMusic . " (id, title, composer, type, image, summary) "
                . "VALUES (NULL, '$title', '$composer', '$type', '$image', '$summary'); ";
        //execute the query
        $query = $this->dbConnection->query($sql);
        
        
        return $query;
    }

    //get all music ratings
    private function get_music_types() {
        $sql = "SELECT * FROM " . $this->tblMusicType;

        //execute the query
        $query = $this->dbConnection->query($sql);

        if (!$query) {
            return false;
        }

        //loop through all rows
        $types = array();
        while ($obj = $query->fetch_object()) {
            $types[$obj->type] = $obj->type_id;
        }
        return $types;
    }

}
