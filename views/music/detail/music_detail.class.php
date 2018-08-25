<?php
/*
 * Author: Enrico Banks
 * Date: 4/26/2018
 * Name: music_view.class.php
 * Description: This class defines a method "display".
 *              The method accepts a Music object and displays the details of the music in a table.
 */

class MusicDetail extends MusicIndexView {

    public function display($music, $confirm = "") {
        //display page header
        parent::displayHeader("Music Details");

        //retrieve music details by calling get methods
       
        $id = $music->getId();
        $title = $music->getTitle();
        $composer = $music->getComposer();
        $type = $music->getType();
        $image = $music->getImage();
        $summary = $music->getSummary();

        if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
            $image = BASE_URL . '/' . MUSIC_IMG . $image;
        }
        ?>

        <div id="main-header">Music Details</div>
        <hr class="mid-line">
        <!-- display music details in a table -->
        <table id="detail">
            <tr>
                <td style="width: 150px;">
                    <img src="<?= $image ?>" alt="<?= $title ?>" />
                </td>
                <td style="width: 130px;">
                    <p><strong>Title:</strong></p>
                    <p><strong>Composer:</strong></p>
                    <p><strong>Type:</strong></p>
                    <p><strong>Image:</strong></p>
                    <p><strong>Summary:</strong></p>
                    
                    <?php //Buttons
                    //Admin user features
                    if (isset($_SESSION['role']) && $_SESSION['role'] == 2){
                        echo    "<div id='button-group'>" .
                                    "<input class='login_button' type='button' id='edit-button' value='   Edit   '" .
                                    "onclick='window.location.href = \"" . BASE_URL . "/music/edit/" . $id . "\";'>&nbsp;" .
                                "</div>";
                    }
                    //Account holder features NOTE:THE HYPERLINK IS WRONG, WAITING FOR JAPHET'S PART
                    //if (isset($_SESSION['role']) && $_SESSION['role'] == 1){
                      //  echo    "<div id='button-group'>" .
                        //            "<input type='button' id='edit-button' value='   Add to Rental Cart   '" .
                          //          "onclick='window.location.href = \"" . BASE_URL . "/waiting/" . $id . "\";'>&nbsp;" .
                            //    "</div>";}
                    ?>
                </td>
                <td>
                    <p><?= $title ?></p>
                    <p><?= $composer ?></p>
                    <p><?= $type ?></p>
                    <p class="media-description"><?= $summary ?></p>
                    <div id="confirm-message"><?= $confirm ?></div>
                </td>
            </tr>
        </table>
        <a style="color: purple; margin-top: 5px" href="<?= BASE_URL ?>/music/index"><i class="fas fa-arrow-circle-left"> Go Back</i></a>

        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
