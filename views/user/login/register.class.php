<?php
//Matthew Carter
//I211
//This is account registration success.
class UserRegister extends IndexView{
    public function display() {
        //display header
        parent::displayHeader("Login Success");
        ?>
        <div id="main-header">Registration Complete!</div>
        <hr>
        <h3>You have successfully created an account.</h3>
        <br><br><br><br><hr>
        <a href="<?= BASE_URL ?>/index">Back to Home Page</a>
        <?php
        $message = "Registration successful!";
        return $message;
        parent::displayFooter();
    }
}
?>