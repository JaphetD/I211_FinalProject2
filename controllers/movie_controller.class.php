<?php

/*
 * Author: Melanie Turner
 * Date: 4/15/2018
 * File: movie_controller.class.php
 * Description: the movie controller class
 *
 */

class MovieController {

    private $movie_model;

    //default constructor
    public function __construct() {
        //create an instance of the MovieModel class
        $this->movie_model = MovieModel::getMovieModel();
    }

    //index action that displays all movies
    public function index() {
        //retrieve all movies and store them in an array
        $movies = $this->movie_model->list_movie();

        if (!$movies) {
            //display an error
            $message = "There was a problem displaying movies.";
            $this->error($message);
            return;
        }

        // display all movies
        $view = new MovieIndex();
        $view->display($movies);
    }

    //show details of a movie
    public function detail($id) {
        //retrieve the specific movie
        $movie = $this->movie_model->view_movie($id);

        if (!$movie) {
            //display an error
            $message = "There was a problem displaying the movie id='" . $id . "'.";
            $this->error($message);
            return;
        }

        //display movie details
        $view = new MovieDetail();
        $view->display($movie);
    }

    //display a movie in a form for editing
    public function edit($id) {
        //retrieve the specific movie
        $movie = $this->movie_model->view_movie($id);

        if (!$movie) {
            //display an error
            $message = "There was a problem displaying the movie id='" . $id . "'.";
            $this->error($message);
            return;
        }

        $view = new MovieEdit();
        $view->display($movie);
    }

    //update a movie in the database
    public function update($id) {
        //update the movie
        $update = $this->movie_model->update_movie($id);
        if (!$update) {
            //handle errors
            $message = "There was a problem updating the movie id='" . $id . "'.";
            $this->error($message);
            return;
        }

        //display the updateed movie details
        $confirm = "The movie was successfully updated.";
        $movie = $this->movie_model->view_movie($id);

        $view = new MovieDetail();
        $view->display($movie, $confirm);
    }

    //search movies
    public function search() {
        //retrieve query terms from search form
        $query_terms = trim($_GET['query-terms']);

        //if search term is empty, list all movies
        if ($query_terms == "") {
            $this->index();
        }

        //search the database for matching movies
        $movies = $this->movie_model->search_movie($query_terms);

        if ($movies === false) {
            //handle error
            $message = "An error has occurred.";
            $this->error($message);
            return;
        }
        //display matched movies
        $search = new MovieSearch();
        $search->display($query_terms, $movies);
    }

    //autosuggestion
    public function suggest($terms) {
        //retrieve query terms
        $query_terms = urldecode(trim($terms));
        $movies = $this->movie_model->search_movie($query_terms);

        //retrieve all movie titles and store them in an array
        $titles = array();
        if ($movies) {
            foreach ($movies as $movie) {
                $titles[] = $movie->getTitle();
            }
        }

        echo json_encode($titles);
    }
    
    //creates form a new movie to the movie database
    public function add() {
        //create a object of the AdminAddMovie Class
        $add = new AdminAddMovie();
        $add->display();
    }
    
    //filters and adds new movie and ratings to corresponding tables
    public function create() {
        //create new movie
        $new_movie = $this->movie_model->create_movie();
        if (!$new_movie) {
            //handle errors
            $message = "There was a problem creating the new movie.";
            $this->error($message);
            return;
        }
        
        //display the updated movie details
        $confirm = "The movie was successfully been created.";
        
        $view = new CreateMovie();
        $view->display($confirm);
    }

    //handle an error
    public function error($message) {
        //create an object of the Error class
        $error = new MovieError();

        //display the error page
        $error->display($message);
    }

    //handle calling inaccessible methods
    public function __call($name, $arguments) {
        //$message = "Route does not exist.";
        // Note: value of $name is case sensitive.
        $message = "Calling method '$name' caused errors. Route does not exist.";

        $this->error($message);
        return;
    }

}
