<?php
// Author: Melanie Turner
// Date: 4/25/2018
//This is new item successfully created page.
class CreateBook extends BookIndexView {
     public function display($confirm) {
        //display header
        parent::displayHeader("Creation Successful");
        ?>
        <div id="main-header">Creating New Product</div>
        <hr>
        <h3>Success!</h3>
        <?= $confirm ?>

        <br><br><br><br><hr>
        <a href="<?= BASE_URL ?>/book/index">Back to Book List</a>
        <?php        
        parent::displayFooter();
    }
}
?>