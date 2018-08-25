<?php
//Matthew Carter
//I211
//This is login success.
class UserVerify extends IndexView {
     public function display() {
        //display header
        parent::displayHeader("Login Success");
        ?>
        <div id="main-header">Login Credentials Verified</div>
        <hr>
        <h3>You are now logged in as:</h3>
        <?= $_SESSION['firstname']; ?> <?= $_SESSION['lastname']; ?>
        <p>Your user id is: <?= $_SESSION['user_id'] ?></p>

        <br><br><br><br><hr>
        <a href="<?= BASE_URL ?>/index">Back to Home Page</a>
        <?php        
        parent::displayFooter();
    }
}
?>

