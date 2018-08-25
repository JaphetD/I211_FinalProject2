<?php
//Matthew Carter and Corey Johnson
//I211
//This is logout success.
class UserLogout extends IndexView {
    public function display() {
        //display header
        parent::displayHeader("Logout Success");
        ?>
        <div id="main-header"></div>
        <hr class="mid-line">
        <br><br>
        <h2 class="logout-text">You are now logged out.</h2>
        <br><br>
        <hr class="mid-line">
        <a style="color: purple; margin-top: 5px" href="<?= BASE_URL ?>/index"><i class="fas fa-arrow-circle-left"> Return to Home</i></a>
        <?php
        parent::displayFooter();
    }
}
?>