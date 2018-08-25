<?php

/*
 * Author: Melanie Turner
 * Date: 4/9/2018
 * File: book_detail.class.php
 * Description: this is the class to define the "display" method
 *              which accepts a Book object and puts the book details into a table for viewing
 */
class BookDetail extends BookIndexView {

    public function display($book, $confirm = "") {
        //display page header
        parent::displayHeader("Book Details");

        //retrieve book details by calling get methods
        $id = $book->getId();
        $title = $book->getTitle();
        $author = $book->getAuthor();
        $category = $book->getCategory();
        $publish_date = new \DateTime($book->getPublish_date());
        $publisher = $book->getPublisher();
        //$edition = $book->getEdition();
        $page_count = $book->getPage_count();
        //$series = $book->getSeries();
        $format = $book->getFormat();
        $image = $book->getImage();
        $summary = $book->getSummary();


        if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
            $image = BASE_URL . '/' . BOOK_IMG . $image;
        }
        ?>

        <div id="main-header">Book Details</div>
        <hr class="mid-line">
        <!-- display book details in a table -->
        <table id="detail">
            <tr>
                <td style="width: 150px;">
                    <img src="<?= $image ?>" alt="<?= $title ?>" />
                </td>
                <td style="width: 130px;">
                    <p><strong>Title:</strong></p>
                    <p><strong>Author:</strong></p>
                    <!--<p><strong>Edition:</strong></p>-->
                    <p><strong>Pages:</strong></p>
                    <!--<p><strong>Series:</strong></p>-->
                    <p><strong>Format:</strong></p>
                    <p><strong>Genre:</strong></p>
                    <!--<p><strong>Publish Date:</strong></p>
                    <p><strong>Publisher:</strong></p>-->
                    <p><strong>Synopsis:</strong></p>
                    
                    <?php //Buttons
                    //Admin user features
                    if (isset($_SESSION['role']) && $_SESSION['role'] == 2){
                        echo    "<div id='button-group'>" .
                                    "<input class='login_button' type='button' id='edit-button' value='   Edit   '" .
                                    "onclick='window.location.href = \"" . BASE_URL . "/book/edit/" . $id . "\";'>&nbsp;" .
                                "</div>";
                    }
                    //Account holder features
                    //if (isset($_SESSION['role']) && $_SESSION['role'] == 1){
                      //  echo    "<div id='button-group'>" .
                        //            "<input type='button' id='edit-button' value='   Add to Rental Cart   '" .
                          //          "onclick='window.location.href = \"" . BASE_URL . "#" . $id . "\";'>&nbsp;" .
                            //    "</div>";}
                    ?>
                </td>
                <td>
                    <p><?= $title ?></p>
                    <p><?= $author ?></p>
                    <!--<p><?php //$edition ?></p>-->
                    <p><?= $page_count ?></p>
                    <!--<p><?php //$series ?></p>-->
                    <p><?= $format ?></p>
                    <p><?= $category ?></p>
                    <!--<p><?php// $publish_date->format('Y-m-d') ?></p>
                    <p><?php // $publisher ?></p>-->
                    <p class="media-description"><?= $summary ?></p>
                    <div id="confirm-message"><?= $confirm ?></div>
                </td>
            </tr>
        </table>
        <a style="color: purple; margin-top: 5px" href="<?= BASE_URL ?>/book/index"><i class="fas fa-arrow-circle-left"> Go Back</i></a>

        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
