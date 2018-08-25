<?php
/*
 * Author: Enrico Banks
 * Date: 4/24/2018
 * File: music_edit.class.php
 * Description: the display method in the class displays music details in a form.
 *
 */
class MusicEdit extends MusicIndexView {

    public function display($music) {
        //display page header
        parent::displayHeader("Edit Music");

        //get music ratings from a session variable
        if (isset($_SESSION['music_types'])) {
            $types = $_SESSION['music_types'];
        } else {
            $types = 0;
        }
        
       
        //retrieve music details by calling get methods
        $id = $music->getId();
        $title = $music->getTitle();
        $composer = $music->getComposer(); 
        $type = $music->getType();
        $image = $music->getImage();
        $summary = $music->getSummary();
        ?>

        <div id="main-header">Edit Music Details</div>

        <!-- display music details in a form -->
        <form class="new-media"  action='<?= BASE_URL . "/music/update/" . $id ?>' method="post" style=" margin-top: 10px; padding: 10px;">
          <input type="hidden" name="id" value="<?= $id ?>">
            <p><input style="min-width: 90%; padding-left: 8px;" placeholder="Title:" class="log-box" name="title" type="text" size="100" value="<?= $title ?>" required autofocus></p>
            <p style="color: purple;"><strong>Type:</strong>&nbsp;
                <?php
                foreach ($types as $m_type => $m_id) {
                    $checked = ($type == $m_type ) ? "checked" : "";
                    echo "<input type='radio' name='type' value='$m_id' $checked> $m_type &nbsp;&nbsp;";
                }?>
            </p>
            <p><input style="min-width: 90%; padding-left: 8px;" placeholder="Composer(s): Separate composers with commas" class="log-box" name="composer" type="text" size="100" value="<?= $composer ?>" required=""></p>
            <p><input style="min-width: 90%; padding-left: 8px;" placeholder="Image: url (http:// or https://) or local file including path and file extension" class="log-box" name="image" type="text" size="100" required value="<?= $image ?>"></p>
            <p><textarea style="min-width: 90%; padding-left: 8px;" placeholder="Summary" name="summary" rows="8" cols="100"><?= $summary ?></textarea></p>
            <input class="login_button" type="submit" name="action" value="Update Music">
            <input class="login_button" type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/music/detail/" . $id ?>"'>  
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}