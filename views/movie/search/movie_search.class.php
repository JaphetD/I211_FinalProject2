<?php
/*
 * Author: Melanie Turner
 * Date: 4/9/2018
 * Name: search.class.php
 * Description: this script defines the SearchMovie class. The class contains a method named display, which
 *     accepts an array of Movie objects and displays them in a grid.
 */

class MovieSearch extends MovieIndexView {
    /*
     * the displays accepts an array of movie objects and displays
     * them in a grid.
     */

     public function display($terms, $movies) {
        //display page header
        parent::displayHeader("Search Results");
        ?>
        <div id="main-header"> Search Results for <i><?= $terms ?></i></div>
        <span class="rcd-numbers">
            <?php
            echo ((!is_array($movies)) ? "( 0 - 0 )" : "( 1 - " . count($movies) . " )");
            ?>
        </span>
        <hr>

       <!-- display all records in a grid -->
               <div class="grid-container">
            <?php
            if ($movies === 0) {
                echo "No movie was found.<br><br><br><br><br>";
            } else {
                //display movies in a grid; six movies per row
                foreach ($movies as $i => $movie) {
                    $id = $movie->getId();
                    $title = $movie->getTitle();
                    $rating = $movie->getRating();
                    $release_date = $release_date = new \DateTime($movie->getRelease_date());
                    $image = $movie->getImage();
                    if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
                        $image = BASE_URL . "/" . MOVIE_IMG . $image;
                    }
                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }

                    echo "<div class='col'><p><a href='" . BASE_URL . "/movie/detail/$id'><img src='" . $image .
                    "'></a>" . /*<span>$title<br>Rated $rating<br>" . $release_date->format('m-d-Y') . "</span>*/"</p></div>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($movies) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>  
        </div>
        <a style="color: purple; margin-top: 5px" href="<?= BASE_URL ?>/movie/index"><i class="fas fa-arrow-circle-left"> Go Back</i></a>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}