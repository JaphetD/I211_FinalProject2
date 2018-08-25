<?php

/*
 * Author: Melanie Turner
 * Date: 4/5/2018
 * File: book_controller.class.php
 * Description: this is the book controller class
 */


class BookController {
    //data member for the book model
    private $book_model;
    
    //the constructor
    public function __construct() {
        //create a BookModel instance
        $this->book_model = BookModel::getBookModel();
    }
    
    //to display all of the books
    public function index() {
        $books = $this->book_model->list_book();
        
        if(!$books) {
            //error needs to display
            $message = "There were problems displaying the books.";
            $this->error($message);
            return;
        }
        
       //now to display all of the books
       $view = new BookIndex();
       $view->display($books);
    }
    
    //for the details to display about a book
    public function detail($id) {
        //retrieve a book
        $book = $this->book_model->view_book($id);
        
        if (!$book) {
            //error display
            $message = "There was an error in displaying the book with the id='" . $id . "'.";
            $this->error($message);
            return;
        }
        
        //retrieve and display the book's details
        $view =  new BookDetail();
        $view->display($book);
    }
    
    //Book Editing form
    public function edit($id) {
        //retrieve a book
        $book = $this->book_model->view_book($id);
        
        if(!$book) {
            //error display
            $message = "There was a problem displaying the book id='" . $id . "'.";
            $this->error($message);
            return;
        }
        
        $view = new BookEdit();
        $view->display($book);
    }
    
    //Update book info in the book table of the database
    public function update($id) {
        //update specific book
        $update = $this->book_model->update_book($id);
        
        if(!$update) {
            //error display
            $message = "There was an error when updating the book with id='" . $id . "'.";
            $this->error($message);
            return;
        }
        
        //check that new data updated in database by displaying details
        $confirm = "The book has successfully updated.";
        $book = $this->book_model->view_book($id);
        
        $view = new BookDetail();
        $view->display($book, $confirm);
    }
    
    //search for a book
    public function search() {
        //retrieves terms from the search box
        $query_terms = trim($_GET['query-terms']);
        
        //if search box is empty, all books are listed
        if ($query_terms == "") {
            $this->index();
        }
        
        //search for matching book titles in the database
        $books = $this->book_model->search_book($query_terms);
        
        if ($books == false) {
            //error display
            $message = "There was an error in the search query.";
            $this->error($message);
            return;
        }
        
        //matched books for display
        $search = new BookSearch();
        $search->display($query_terms, $books);
    }
    
    //autosuggest feature
    public function suggest($terms) {
        //retrieve query terms
        $query_terms = urldecode(trim($terms));
        $books = $this->book_model->search_book($query_terms);
        
        //retrieve all books to be stored in following array
        $titles = array();
        if ($books) {
            foreach ($books as $book) {
                $titles[] = $book->getTitle();
            }
        }
        
        echo json_encode($titles);
    }
    
    //creates form a new book to the book database
    public function add() {
        //create a object of the AdminAddBook Class
        $add = new AdminAddBook();
        $add->display();
    }
    
    //filters and adds new book and ratings to corresponding tables
    public function create() {
        //create new book
        $new_book = $this->book_model->create_book();
        if (!$new_book) {
            //handle errors
            $message = "There was a problem creating the new book.";
            $this->error($message);
            return;
        }
        
        //display the updated book details
        $confirm = "The book was successfully created.";
        
        $view = new CreateBook();
        $view->display($confirm);
    }
    
    //to handle and display all types of errors
    public function error($message) {
        //creates Error class object
        $error = new BookError();
        
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
