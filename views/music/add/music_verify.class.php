<?php
// Author: Enrico Banks
// Date: 4/27/2018
//This is new item successfully created page.
class CreateMusic extends MusicIndexView {
     public function display($confirm) {
        //display header
        parent::displayHeader("Creation Successful");
        ?>
        <div id="main-header">Creating New Product</div>
        <hr>
        <h3>Success!</h3>
        <?= $confirm ?>

        <br><br><br><br><hr>
        <a style="color: purple; margin-top: 5px" href="<?= BASE_URL ?>/music/index"><i class="fas fa-arrow-circle-left"> Go Back</i></a>
        <?php        
        parent::displayFooter();
    }
}
?>