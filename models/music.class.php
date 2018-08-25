<?php
/*
 * Author: Enrico Banks
 * Date: 4/26/2018
 * Name: music.class.php
 * Description: the music class models real-world music.
 */

class Music {

    //private data members
    private $id, $title, $composer, $type, $image, $summary;

    //the constructor
    public function __construct($title, $composer, $type, $image, $summary) {
        $this->title = $title;
        $this->composer = $composer;
        $this->type = $type;
        $this->image = $image;
        $this->summary = $summary;
    }
	
	//getters
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getComposer() {
        return $this->composer;
    }

    public function getType() {
        return $this->type;
    }

    public function getImage() {
        return $this->image;
    }

    public function getSummary() {
        return $this->summary;
    }

    //set movie id
    public function setId($id) {
        $this->id = $id;
    }

}