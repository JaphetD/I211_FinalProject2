<?php
/*
 * Author: Enrico Banks
 * Date: 4/26/2018
 * Name: search.class.php
 * Description: this script defines the SearchMusic class. The class contains a method named display, which
 *     accepts an array of Music objects and displays them in a grid.
 */

class MusicSearch extends MusicIndexView {

     public function display($query_terms, $musics) {
        //display page header
        parent::displayHeader("Search Results");
        ?>
        <div id="main-header"> Search Results for <i><?= $query_terms ?></i></div>
        <span class="rcd-numbers">
            <?php
            echo ((!is_array($musics)) ? "( 0 - 0 )" : "( 1 - " . count($musics) . " )");
            ?>
        </span>
        <hr>

       <!-- display all records in a grid -->
               <div class="grid-container">
            <?php
            if ($musics === 0) {
                echo "No music was found.<br><br><br><br><br>";
            } else {
                //display movies in a grid; six movies per row
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

                    echo "<div class='col'><p><a href='" . BASE_URL . "/music/detail/$id'><img src='" . $image .
                    "'></a>" . /*<span>$title<br>Composer $composer<br>Type $type<br>" . "</span>*/"</p></div>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($musics) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>  
        </div>
        <a style="color: purple; margin-top: 5px" href="<?= BASE_URL ?>/music/index"><i class="fas fa-arrow-circle-left"> Go Back</i></a>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}