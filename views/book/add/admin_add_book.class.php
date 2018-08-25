<?php

/*
 * Author: Melanie Turner
 * Date: 4/24/2018
 * File: admin_add_book.class.php 
 * Description: defines class that adds a book to database, method of displaying form
 */
class AdminAddBook extends BookIndexView {

    public function display() {
        //display page header
        parent::displayHeader("Add Book");
        
        //get book categories from a session variable
        if (isset($_SESSION['book_categories'])) {
            $categories = $_SESSION['book_categories'];
        }
        ?>

<div id="main-header">Add New Book Details</div>

        <!-- display book details in a form -->
        <form class="new-media"  action="<?= BASE_URL ?>/book/create/" method="post" style="margin-top: 10px; padding: 10px;">
            <input style="min-width: 90%; padding-left: 8px;" type="hidden" name="id" value="<?= $id ?>">
            <p>
                <!--<strong>Title</strong>-->
                
                <input style="min-width: 90%; padding-left: 8px;" name="title" placeholder="Title" class="log-box" type="text" size="100" value="" required autofocus></p>
            <p style="color: purple;"><strong>Genre</strong>:
                <?php
                foreach ($categories as $b_category => $b_id) {
                    echo "<input type='radio' name='category' value='$b_id' > $b_category &nbsp;&nbsp;";
                }
                ?>
            </p>
            <p>
                <!--<strong>Author</strong>-->
                <input style="min-width: 90%; padding-left: 8px;" name="author" placeholder="Author: Separate authors with commas" class="log-box" type="text" value="" required=""></p>
            <p>
                <!--<strong>Page Count</strong>-->
               
                <input style="min-width: 90%; padding-left: 8px;" name="page_count" placeholder="Page Count: List amount of pages in book" class="log-box" type="number" size="40" value="" required=""></p>
            <p>
                <!--<strong>Format</strong>-->
                
                <input style="min-width: 90%; padding-left: 8px;" name="format" placeholder="Format: Hardcover, Paperback, etc." class="log-box"type="text" size="40" value="" required=""></p>
            <p>
                <!--<strong>Image</strong>-->
              
                <input style="min-width: 90%; padding-left: 8px;" name="image" placeholder="Image: url (http:// or https://) or local file including path and file extension" class="log-box" type="text" size="100" required value=""></p>
            <p>
                <!--<strong>Synopsis</strong>-->
              
                <textarea style="min-width: 90%; padding-left: 8px;" name="summary" placeholder="Synopsis:" rows="8" cols="100"></textarea></p>
            <input type="submit" class="login_button" name="action" value="Add Book">
            <input type="button" class="login_button" value="Cancel" onclick="window.location.href = '<?= BASE_URL ?>/index.php'">  
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
