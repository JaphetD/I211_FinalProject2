<?php

/*
 * Author: Melanie Turner
 * Date: 4/24/2018
 * File: admin_add_movie.class.php 
 * Description: defines class that adds a movie to database, method of displaying form
 */
class AdminAddMovie extends MovieIndexView {

    public function display() {
        //display page header
        parent::displayHeader("Add Movie");
        
        //get movie ratings from a session variable
        if (isset($_SESSION['movie_ratings'])) {
            $ratings = $_SESSION['movie_ratings'];
        }
        ?>

        <div id="main-header">Add New Movie Details</div>

        <!-- display movie details in a form -->
        <form class="new-media"  action="<?= BASE_URL ?>/movie/create/" method="post" style="margin-top: 10px; padding: 10px;">
          <input type="hidden" name="id" value="<?= $id ?>">
            <p><input style="min-width: 90%; padding-left: 8px;" placeholder="Title" class="log-box" name="title" type="text" size="100" value="" required autofocus></p>
            <p style="color: purple;"><strong>Rating</strong>:
                <?php
                foreach ($ratings as $m_rating => $m_id) {
                    echo "<input type='radio' name='rating' value='$m_id' > $m_rating &nbsp;&nbsp;";
                }
                ?>
            </p>
            <p><input style="min-width: 90%; padding-left: 8px;" placeholder="Release Date: " class="log-box" name="release_date" type="date" value="" required=""></p>
            <p><input style="min-width: 90%; padding-left: 8px;" placeholder="Director(s): Seperate directors with commas" class="log-box" name="director" type="text" size="40" value="" required=""></p>
            <p><input style="min-width: 90%; padding-left: 8px;" placeholder="Image: url (http:// or https://) or local file including path and file extension" class="log-box" name="image" type="text" size="100" required value=""></p>
            <p><textarea style="min-width: 90%; padding-left: 8px;" placeholder="Description" name="description" rows="8" cols="100"></textarea></p>
            <input type="submit" class="login_button" name="action" value="Add New Movie">
            <input type="button" class="login_button" value="Cancel" onclick="window.location.href = '<?= BASE_URL ?>/index.php'">  
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
