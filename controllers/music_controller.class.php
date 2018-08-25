<?php

/*
 * Author: Enrico Banks
 * Date: 4/5/2018
 * File: music_controller.class.php
 * Description: this is the music controller class
 */


class MusicController {
    //data member for the music model
    private $music_model;
    
    //the constructor
    public function __construct() {
        //create a BookModel instance
        $this->music_model = MusicModel::getMusicModel();
    }
    
    //to display all of the music
    public function index() {
        $musics = $this->music_model->list_music();

        if(!$musics) {
            //error needs to display
            $message = "There were problems displaying the music.";
            $this->error($message);
            return;
        }
        
       //now to display all of the music
       $view = new MusicIndex();
       $view->display($musics);
    }

    //for the details to display about a music
    public function detail($id) {
        //retrieve a music
        $music = $this->music_model->view_music($id);
        if (!$music) {
            //error display
            $message = "There was an error in displaying the music with the id='" . $id . "'.";
            $this->error($message);
            return;
        }
        
        //retrieve and display the music's details
        $view =  new MusicDetail();
        $view->display($music);
    }
    
    //Book Editing form
    public function edit($id) {
        //retrieve a music
        $music = $this->music_model->view_music($id);
        
        if(!$music) {
            //error display
            $message = "There was a problem displaying the music id='" . $id . "'.";
            $this->error($message);
            return;
        }
        
        $view = new MusicEdit();
        $view->display($music);
    }
    
    //Update music info in the music table of the database
    public function update($id) {
        //update specific music
        $update = $this->music_model->update_music($id);
        
        
        if(!$update) {
            //error display
            $message = "There was an error when updating the music with id='" . $id . "'.";
            $this->error($message);
            return;
        }
        
        //check that new data updated in database by displaying details
        $confirm = "The music has successfully updated.";
        $music = $this->music_model->view_music($id);
        
        $view = new MusicDetail();
        $view->display($music, $confirm);
    }
    
    //search for a music
    public function search() {
        //retrieves terms from the search box
        $query_terms = trim($_GET['query-terms']);
        
        //if search box is empty, all music are listed
        if ($query_terms == "") {
            $this->index();
        }
        
        //search for matching music titles in the database
        $musics = $this->music_model->search_music($query_terms);
        
        if ($musics == false) {
            
            //error display
            $message = "There was an error in the search query.";
            
            $this->error($message);
            
            return;
            
        }
        
        //matched music for display
        $search = new MusicSearch();
        $search->display($query_terms, $musics);
        
    }   
    
    //autosuggest feature
    public function suggest($terms) {
        //retrieve query terms
        $query_terms = urldecode(trim($terms));
        $musics = $this->music_model->search_music($query_terms);
        
        //retrieve all music to be stored in following array
        $titles = array();
        if ($musics) {
            foreach ($musics as $music) {
                $titles[] = $music->getTitle();
            }
        }
        
        echo json_encode($titles);
    }
    
    //creates form a new music to the music database
    public function add() {
        //create a object of the AdminAddMusic Class
        $add = new AdminAddMusic();
        $add->display();
    }
    
    //filters and adds new music and types to corresponding tables
    public function create() {
        //create new music
        $new_music = $this->music_model->create_music();
        if (!$new_music) {
            //handle errors
            $message = "There was a problem creating the new music.";
            $this->error($message);
            return;
        }
        
        //display the updated movie details
        $confirm = "The music was successfully been created.";
        
        $view = new CreateMusic();
        $view->display($confirm);
    }

    //to handle and display all types of errors
    public function error($message) {
        //creates Error class object
        $error = new MusicError();
        
        //display errors on page
        $error->display($message);
    }
    
    //to handle when an inaccessible method is being called
    public function __call($name, $arguments) {
        $message = "Calling method '$name' caused errors. This route doesn't exist.";
        
        $this->error($message);
        return;
    }
    
}
