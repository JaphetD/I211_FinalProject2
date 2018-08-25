<?php

/*
 * Author: Enrico Banks
 * Date: 4/27/2018
 * File: admin_add_music.class.php 
 * Description: defines class that adds a music to database, method of displaying form
 */
class AdminAddMusic extends MusicIndexView {

    public function display() {
        //display page header
        parent::displayHeader("Add Music");
        
        //get music types from a session variable
        if (isset($_SESSION['music_types'])) {
            $types = $_SESSION['music_types'];
        }
        ?>

        <div id="main-header">Add New Music Details</div>
        <div>
        <!-- display music details in a form -->
        <form class="new-media"  action="<?= BASE_URL ?>/music/create/" method="post" style="margin-top: 10px; padding: 10px;">
          <input type="hidden" name="id" value="<?= $id ?>">
            <p><input style="min-width: 90%; padding-left: 8px;" placeholder="Title:" class="log-box" name="title" type="text" size="100" value="" required autofocus></p>
            <p style="color: purple;"><strong>Type:</strong>&nbsp;
                <?php
                foreach ($types as $mu_type => $mu_id) {
                    echo "<input type='radio' name='type' value='$mu_id'> $mu_type &nbsp;&nbsp;";
                }?>
            </p>
            <p><input style="min-width: 90%; padding-left: 8px;" placeholder="Composer(s): Separate composers with commas" class="log-box"  name="composer" type="text" size="40" value="" required=""></p>
            <p><input style="min-width: 90%; padding-left: 8px;" placeholder="Image: url (http:// or https://) or local file including path and file extension" class="log-box" name="image" type="text" size="100" required value=""></p>
            <p><textarea style="min-width: 90%; padding-left: 8px;" placeholder="Summary" name="summary" rows="8" cols="100"></textarea></p>
            <input type="submit" class="login_button" name="action" value="Create New Music">
            <input type="button" class="login_button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/music/detail/" . $id ?>"'>
        </form>
        </div>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
