<?php
/*
 * Author: Melanie Turner
 * Date: 4/19/2018  
 * File: book_edit.class.php
 * Description: the display method in the class displays book details in a form.
 *
 */
class BookEdit extends BookIndexView {

    public function display($book) {
        //display page header
        parent::displayHeader("Edit Book");

        //get book categories from a session variable
        if (isset($_SESSION['book_categories'])) {
            $categories = $_SESSION['book_categories'];
        }
        
        //retrieve book details by calling get methods
        $id = $book->getId();
        $title = $book->getTitle();
        $author = $book->getAuthor();
        $category = $book->getCategory();
        $page_count = $book->getPage_count();
        $format = $book->getFormat();
        //$publish_date = $book->getPublish_date();
        //$publisher = $book->getPublisher();
        $image = $book->getImage();
        $summary = $book->getSummary();
        ?>

        <div id="main-header">Edit Book Details</div>

        <!-- display book details in a form -->
        <form class="new-media"  action='<?= BASE_URL . "/book/update/" . $id ?>' method="post" style=" margin-top: 10px; padding: 10px;">
          <input type="hidden" name="id" value="<?= $id ?>">
            <p>
                <input style="min-width: 90%; padding-left: 8px;" class="log-box" name="title" placeholder="Title" type="text" size="100" value="<?= $title ?>" required autofocus></p>
            <p style="color: purple;"><strong>Genre</strong>:
                <?php
                foreach ($categories as $b_category => $b_id) {
                    $checked = ($category == $b_category ) ? "checked" : "";
                    echo "<input type='radio' name='category' value='$b_id' $checked> $b_category &nbsp;&nbsp;";
                }
                ?>
            </p>
            <p><input style="min-width: 90%; padding-left: 8px;" class="log-box" name="author" placeholder="Author: Separate authors with commas" type="text" size="100" value="<?= $author ?>" required=""></p>
            <p><input style="min-width: 90%; padding-left: 8px;" class="log-box" name="page_count" placeholder="Pages: Number of pages in book" type="number" size="100" value="<?= $page_count ?>" required=""></p>
            <p><input style="min-width: 90%; padding-left: 8px;" class="log-box" name="format" placeholder="Book Format: Hardcover, Paperback, etc." name="format" type="text" size="40" value="<?= $format ?>" required=""></p>
            <p><input style="min-width: 90%; padding-left: 8px;" class="log-box" placeholder="Images: url (http:// or https://) or local file including path and file extension" name="image" type="text" size="100" required value="<?= $image ?>"></p>
            <p><strong>Summary</strong>:<br>
                <textarea style="min-width: 90%; padding-left: 8px;" name="summary" rows="8" cols="100"><?= $summary ?></textarea></p>
            <input type="submit" class="login_button" name="action" value="Update Book">
            <input type="button" class="login_button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/book/detail/" . $id ?>"'>  
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}