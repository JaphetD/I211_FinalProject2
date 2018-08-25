<?php
/*
 * Author: Enrico Banks
 * Date: 4/26/2018
 * Name: music_index.class.php
 * Description: This class defines a method called "display", which displays all musics.
 *              displays in grid form
 */
class MusicIndex extends MusicIndexView {
    
    public function display($musics) {
        //display page header
        parent::displayHeader("List All Music");
        ?>
        <div id="main-header"> Music in the Library</div>

        <div class="grid-container">
            <?php
            if ($musics === 0) {
                echo "No music was found.<br><br><br><br><br>";
            } else {
                //display musics in a grid; six music per row
                foreach ($musics as $i => $music) {
                    $id = $music->getId();
                    $title = $music->getTitle();
                    $composer = $music->getComposer();
                    $type = $music->getType();
                    $image = $music->getImage();
                    if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
                        $image = BASE_URL . "/" . MUSIC_IMG . $image;
                    }
                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }

                    echo "<div class='col'><p><a href='", BASE_URL, "/music/detail/$id'><img src='" . $image .
                    "'></a>"/*<span>$title<br>$composer<br>$type</span>*/."</p></div>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($musics) - 1) {
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
