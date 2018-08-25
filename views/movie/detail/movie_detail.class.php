<?php
/*
 * Author: Melanie Turner
 * Date: 4/19/2018
 * Name: movie_view.class.php
 * Description: This class defines a method "display".
 *              The method accepts a Movie object and displays the details of the movie in a table.
 */

class MovieDetail extends MovieIndexView {

    public function display($movie, $confirm = "") {
        //display page header
        parent::displayHeader("Movie Details");

        //retrieve movie details by calling get methods
        $id = $movie->getId();
        $title = $movie->getTitle();
        $rating = $movie->getRating();
        $release_date = new \DateTime($movie->getRelease_date());
        $director = $movie->getDirector();
        $image = $movie->getImage();
        $description = $movie->getDescription();


        if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
            $image = BASE_URL . '/' . MOVIE_IMG . $image;
        }
        ?>

        <div id="main-header">Movie Details</div>
        <hr class="mid-line">
        <!-- display movie details in a table -->
        <table id="detail">
            <tr>
                <td style="width: 150px;">
                    <img src="<?= $image ?>" alt="<?= $title ?>" />
                </td>
                <td style="width: 130px;">
                    <p><strong>Title:</strong></p>
                    <p><strong>Rating:</strong></p>
                    <p><strong>Release Date:</strong></p>
                    <p><strong>Director:</strong></p>
                    <p><strong>Description:</strong></p>
                    
                    <?php //Buttons
                    //Admin user features
                    if (isset($_SESSION['role']) && $_SESSION['role'] == 2){
                        echo    "<div id='button-group'>" .
                                    "<input class='login_button' type='button' id='edit-button' value='   Edit   '" .
                                    "onclick='window.location.href = \"" . BASE_URL . "/movie/edit/" . $id . "\";'>&nbsp;" .
                                "</div>";
                    }
                    //Account holder features NOTE:THE HYPERLINK IS WRONG, WAITING FOR JAPHET'S PART if we choose to add cart feature
                    //if (isset($_SESSION['role']) && $_SESSION['role'] == 1){
                      //  echo    "<div id='button-group'>" .
                        //            "<input type='button' id='edit-button' value='   Add to Rental Cart   '" .
                          //          "onclick='window.location.href = \"" . BASE_URL . "/waiting/" . $id . "\";'>&nbsp;" .
                            //    "</div>";}
                    ?>
                </td>
                <td>
                    <p><?= $title ?></p>
                    <p><?= $rating ?></p>
                    <p><?= $release_date->format('m-d-Y') ?></p>
                    <p><?= $director ?></p>
                    <p class="media-description"><?= $description ?></p>
                    <div id="confirm-message"><?= $confirm ?></div>
                </td>
            </tr>
        </table>
        <a style="color: purple; margin-top: 5px" href="<?= BASE_URL ?>/movie/index"><i class="fas fa-arrow-circle-left"> Go Back</i></a>

        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
