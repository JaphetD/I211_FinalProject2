<?php

/*
 * Author: Melanie Turner
 * Date: April 9, 2018
 * File: book_model.class.php
 * Description: this acts as the model for a book object
 */
class BookModel {
    //data members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblBook;
    private $tblBookCategory;

    //To use singleton pattern, this constructor is made private. To get an instance of the class, the getBookModel method must be called.
    private function __construct() {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblBook = $this->db->getBookTable();
        $this->tblBookCategory = $this->db->getBookCategoryTable();

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
        //initialize book categories
        if (!isset($_SESSION['book_categories'])) {
            $categories = $this->get_book_categories();
            $_SESSION['book_categories'] = $categories;
        }
    }

    //static method to ensure there is just one BookModel instance
    public static function getBookModel() {
        if (self::$_instance == NULL) {
            self::$_instance = new BookModel();
        }
        return self::$_instance;
    }

    /*
     * the list_book method retrieves all books from the database and
     * returns an array of Book objects if successful or false if failed.
     * Books should also be filtered by categories and/or sorted by titles or categories if they are available.
     */

    public function list_book() {
        /* construct the sql SELECT statement in this format
         * SELECT ...
         * FROM ...
         * WHERE ...
         */

        $sql = "SELECT * FROM " . $this->tblBook . "," . $this->tblBookCategory .
                " WHERE " . $this->tblBook . ".category=" . $this->tblBookCategory . ".category_id";

        //execute the query
        $query = $this->dbConnection->query($sql);

        // if the query failed, return false. 
        if (!$query)
            return false;

        //if the query succeeded, but no book was found.
        if ($query->num_rows == 0)
            return 0;

        //handle the result
        //create an array to store all returned books
        $books = array();

        //loop through all rows in the returned recordsets
        while ($obj = $query->fetch_object()) {
            $book = new Book(stripslashes($obj->title), stripslashes($obj->author), stripslashes($obj->publish_date), stripslashes($obj->publisher), stripslashes($obj->edition), stripslashes($obj->page_count), stripslashes($obj->series), stripslashes($obj->format), stripslashes($obj->category), stripslashes($obj->image), stripslashes($obj->summary));
            
            //set the id for the book
            $book->setId($obj->id);

            //add the book into the array
            $books[] = $book;
        }
        return $books;
    }

    /*
     * the viewBook method retrieves the details of the book specified by its id
     * and returns a book object. Return false if failed.
     */

    public function view_book($id) {
        //the select ssql statement
        $sql = "SELECT * FROM " . $this->tblBook . "," . $this->tblBookCategory .
                " WHERE " . $this->tblBook . ".category=" . $this->tblBookCategory . ".category_id" .
                " AND " . $this->tblBook . ".id='$id'";

        //execute the query
        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            $obj = $query->fetch_object();

            //create a book object
            $book = new Book(stripslashes($obj->title), stripslashes($obj->author), stripslashes($obj->publish_date), stripslashes($obj->publisher), stripslashes($obj->edition), stripslashes($obj->page_count), stripslashes($obj->series), stripslashes($obj->format), stripslashes($obj->category), stripslashes($obj->image), stripslashes($obj->summary));

            //set the id for the book
            $book->setId($obj->id);

            return $book;
        }

        return false;
    }

    //the update_book method updates an existing book in the database. Details of the book are posted in a form. Return true if succeed; false otherwise.
    public function update_book($id) {
        //if the script did not received post data, display an error message and then terminite the script immediately
        if (!filter_has_var(INPUT_POST, 'title') ||
                !filter_has_var(INPUT_POST, 'author') ||
                !filter_has_var(INPUT_POST, 'category') ||
                !filter_has_var(INPUT_POST, 'page_count') ||
                !filter_has_var(INPUT_POST, 'format') ||
                !filter_has_var(INPUT_POST, 'image') ||
                !filter_has_var(INPUT_POST, 'summary')) {

            return false;
        }

        //retrieve data for the new book; data are sanitized and escaped for security.
        $title = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING)));
        $author = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING)));
        $page_count = $this->dbConnection->real_escape_string(filter_input(INPUT_POST, 'page_count', FILTER_SANITIZE_NUMBER_INT));
        $format = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'format', FILTER_SANITIZE_STRING)));
        $category = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT)));
        $image = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));
        $summary = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'summary', FILTER_SANITIZE_STRING)));

        //query string for update 
        $sql = "UPDATE " . $this->tblBook .
                " SET title='$title', author='$author', page_count='$page_count', format='$format', "
                . "category='$category', image='$image', summary='$summary' WHERE id='$id'";

        //execute the query
        return $this->dbConnection->query($sql);
    }

    //search the database for books that match words in titles. Return an array of books if succeed; false otherwise.
    public function search_book($terms) {
        $terms = explode(" ", $terms); //explode multiple terms into an array
        //select statement for AND serach
        $sql = "SELECT * FROM " . $this->tblBook . "," . $this->tblBookCategory .
                " WHERE " . $this->tblBook . ".category=" . $this->tblBookCategory . ".category_id AND (1";

        foreach ($terms as $term) {
            $sql .= " AND title LIKE '%" . $term . "%'";
        }

        $sql .= ")";

        //execute the query
        $query = $this->dbConnection->query($sql);

        // the search failed, return false. 
        if (!$query)
            return false;

        //search succeeded, but no book was found.
        if ($query->num_rows == 0)
            return 0;

        //search succeeded, and found at least 1 book found.
        //create an array to store all the returned books
        $books = array();

        //loop through all rows in the returned recordsets
        while ($obj = $query->fetch_object()) {
            $book = new Book($obj->title, $obj->author, $obj->publish_date, $obj->publisher, $obj->edition, $obj->page_count, $obj->series, $obj->format, $obj->category, $obj->image, $obj->summary);

            //set the id for the book
            $book->setId($obj->id);

            //add the book into the array
            $books[] = $book;
        }
        return $books;
    }
    
    //add new book to the book database
    public function create_book() {
        //if the script did not received post data, display an error message and then terminite the script immediately
        if (!filter_has_var(INPUT_POST, 'title') ||
                !filter_has_var(INPUT_POST, 'author') ||
                !filter_has_var(INPUT_POST, 'page_count') ||
                !filter_has_var(INPUT_POST, 'format') ||
                !filter_has_var(INPUT_POST, 'category') ||
                !filter_has_var(INPUT_POST, 'image') ||
                !filter_has_var(INPUT_POST, 'summary')) {

            return false;
        }

        //retrieve data for the new book; data are sanitized and escaped for security.
        $title = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING)));
        $author = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING)));
        $page_count = $this->dbConnection->real_escape_string(filter_input(INPUT_POST, 'page_count', FILTER_SANITIZE_NUMBER_INT));
        $format = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'format', FILTER_SANITIZE_STRING)));
        $category = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING)));
        $image = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));
        $summary = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'summary', FILTER_SANITIZE_STRING)));

        //query string for update 
        $sql = "INSERT INTO " . $this->tblBook . " (id, title, author, publish_date, publisher, edition, page_count, series, format, category, image, summary) "
                . "VALUES (NULL, '$title', '$author', NULL, NULL, NULL, '$page_count', NULL, '$format', '$category', '$image', '$summary'); ";
        //execute the query
        $query = $this->dbConnection->query($sql);
        
        return $query;
    }

    //get all book ratings
    private function get_book_categories() {
        $sql = "SELECT * FROM " . $this->tblBookCategory;

        //execute the query
        $query = $this->dbConnection->query($sql);

        if (!$query) {
            return false;
        }

        //loop through all rows
        $categories = array();
        while ($obj = $query->fetch_object()) {
            $categories[$obj->category] = $obj->category_id;
        }
        return $categories;
    }
}
