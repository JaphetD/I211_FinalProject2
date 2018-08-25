<?php

/*
 * Author: Melanie Turner
 * Date: 4/8/2018
 * File: book_index.class.php
 * Description: this class defines a display method to view all books
 *              displays in grid form
 */
class BookIndex extends BookIndexView {
    
    public function display($books) {
        //display page header
        parent::displayHeader("List All Books");
        ?>
        <div id="main-header"> Books in the Library</div>

        <div class="grid-container">
            <?php
            if ($books === 0) {
                echo "No book was found.<br><br><br><br><br>";
            } else {
                //display books in a grid; six books per row
                foreach ($books as $i => $book) {
                    $id = $book->getId();
                    $title = $book->getTitle();
                    $category = $book->getCategory();
                    $author = $book->getAuthor();
                    $image = $book->getImage();
                    if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
                        $image = BASE_URL . "/" . BOOK_IMG . $image;
                    }
                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }

                    echo "<div class='col'><p><a href='", BASE_URL, "/book/detail/$id'><img src='" . $image .
                    "'></a>"/*<span>$title<br>$author<br>$category</span>*/."</p></div>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($books) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>  
        </div>
       
        <?php
        //display page footer
        parent::displayFooter();
    } //end of display method
    
}
