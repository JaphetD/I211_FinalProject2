<?php
/*
 * Author: Melanie Turner
 * Date: 4/9/2018
 * File: movie_edit.class.php
 * Description: the display method in the class displays movie details in a form
 *              for the admin to edit with
 *
 */
class MovieEdit extends MovieIndexView {

    public function display($movie) {
        //display page header
        parent::displayHeader("Edit Movie");

        //get movie ratings from a session variable
        if (isset($_SESSION['movie_ratings'])) {
            $ratings = $_SESSION['movie_ratings'];
        }
        
        //retrieve movie details by calling get methods
        $id = $movie->getId();
        $title = $movie->getTitle();
        $rating = $movie->getRating();
        $release_date = $movie->getRelease_date();
        $director = $movie->getDirector();
        $image = $movie->getImage();
        $description = $movie->getDescription();
        ?>

        <div id="main-header">Edit Movie Details</div>

        <!-- display movie details in a form -->
        <form class="new-media"  action='<?= BASE_URL . "/movie/update/" . $id ?>' method="post" style="margin-top: 10px; padding: 10px;">
          <input type="hidden" name="id" value="<?= $id ?>">
            <p>
                <!--<strong>Title</strong><br>-->
                <input style="min-width: 90%; padding-left: 8px;" class="log-box" placeholder="Title:" name="title" type="text" size="100" value="<?= $title ?>" required autofocus></p>
            <p style="color: purple;">
                <strong>Rating</strong>:
                <?php
                foreach ($ratings as $m_rating => $m_id) {
                    $checked = ($rating == $m_rating ) ? "checked" : "";
                    echo "<input type='radio' name='rating' value='$m_id' $checked> $m_rating &nbsp;&nbsp;";
                }
                ?>
            </p>
            <p>
                <!--<strong>Release Date</strong>:--> 
                <input style="min-width: 90%; padding-left: 8px;" placeholder="Release Date:" class="log-box" name="release_date" type="date" value="<?= $release_date ?>" required=""></p>
            <p>
                <!--<strong>Directors</strong>: Separate directors with commas<br>-->
                <input style="min-width: 90%; padding-left: 8px;" class="log-box" placeholder="Director(s): Separate directors with commas" name="director" type="text" size="40" value="<?= $director ?>" required=""></p>
            <p>
                <!--<strong>Image</strong>: url (http:// or https://) or local file including path and file extension<br>-->
                <input style="min-width: 90%; padding-left: 8px;" class="log-box" placeholder="Image: url (http:// or https://) or local file including path and file extension" name="image" type="text" size="100" required value="<?= $image ?>"></p>
            <p>
                <!--<strong>Description</strong>:<br>-->
                <textarea style="min-width: 90%; padding-left: 8px;" placeholder="Description" name="description" rows="8" cols="100"><?= $description ?></textarea></p>
            <input type="submit" class="login_button" name="action" value="Update Movie">
            <input type="button" class="login_button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/movie/detail/" . $id ?>"'>  
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}