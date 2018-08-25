<?php

/*
 * Author: Melanie Turner
 * Date: April 9, 2018
 * Name: movie.class.php
 * Description: the Movie class models a real-world movie.
 */

class Movie {

    //private data members
    private $id, $title, $rating, $release_date, $director, $image, $description;

    //the constructor
    public function __construct($title, $rating, $release_date, $director, $image, $description) {
        $this->title = $title;
        $this->rating = $rating;
        $this->release_date = $release_date;
        $this->director = $director;
        $this->image = $image;
        $this->description = $description;
    }
	
	//getters
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getRating() {
        return $this->rating;
    }

    public function getRelease_date() {
        return $this->release_date;
    }

    public function getDirector() {
        return $this->director;
    }

    public function getImage() {
        return $this->image;
    }

    public function getDescription() {
        return $this->description;
    }

    //set movie id
    public function setId($id) {
        $this->id = $id;
    }

}