<?php
/*
 * Author: Melanie Turner
 * Date: April 9, 2018
 * File: book.class.php
 * Description: this acts as the model for a book object
 */

class Book {
    
    //private properties of a Book object
    private $id, $title, $author, $publish_date, $publisher, $edition;
    private $page_count, $series, $format, $category, $image, $summary;
    
    //the constructor that initializes all properties
    public function __construct($title, $author, $publish_date, $publisher, $edition, $page_count, $series, $format, $category, $image, $summary) {
        $this->title = $title;
        $this->author = $author;
        $this->publish_date = $publish_date;
        $this->publisher = $publisher;
        $this->edition = $edition;
        $this->page_count = $page_count;
        $this->series = $series;
        $this->format = $format;
        $this->category = $category;  
        $this->image = $image;
        $this->summary = $summary;
    }
    
    //get the id of a book
    public function getId() {
        return $this->id;
    }
	
	//get the title of a book
    public function getTitle() {
        return $this->title;
    }

	//get the ISBN of a book
    public function getAuthor() {
        return $this->author;
    }

	//get the publish date of a book
    public function getPublish_date() {
        return $this->publish_date;
    }

	//get the publisher of a book
    public function getPublisher() {
        return $this->publisher;
    }
    
	//get the category of a book
    public function getEdition() {
        return $this->edition;
    }
    	
	//get the category of a book
    public function getPage_count() {
        return $this->page_count;
    }
    	
	//get the category of a book
    public function getSeries() {
        return $this->series;
    }
    	
	//get the category of a book
    public function getFormat() {
        return $this->format;
    }
    	
	//get the category of a book
    public function getCategory() {
        return $this->category;
    }

        //get the image file name of a book
    public function getImage() {
        return $this->image;
    }

	//get the description of a book
    public function getSummary() {
        return $this->summary;
    }

    //set book id
    public function setId($id) {
        $this->id = $id;
    }

}
