<?php
//Matthew Carter
//I211
//This is just a login/registration form. No idea how it would connect to our structure.
class UserLogin extends IndexView {
    public function display() {
        //display page header
        parent::displayHeader("Login Page");
        ?>
<div id="main-header">Login or Register New Account:</div>
<hr class="mid-line">
<div class="content_wrapper">
    <div class="left_column">
        <h3 class="color-text-log">Login</h3>
        <form action='<?= BASE_URL ?>/user/verify/' method="post">
            <!--<label for="username">Username:</label>-->
            <input class="log-box" name="username"  placeholder="Username" id="username"><br>
            <!--<label for="password">Password:</label>-->
            <input class="log-box" name="password"  type="password" placeholder="Password" id="password"><br>
            <input class="login_button" type="submit" value="Submit" />
            <input class="login_button" type="reset" value="Reset" name="reset" />
        </form>
    </div>
    <div class="mid_column"></div>
    <div class="right_column">
        <h3 class="color-text-log">Register</h3>
        <form action='<?= BASE_URL ?>/user/register' method="post">
            <input class="log-box" name="firstname" placeholder="First Name" id="firstname"><br>
            <input class="log-box" name="lastname" placeholder="Last Name" id="lastname"><br>
            <input class="log-box" name="username" placeholder="Username" id="username"><br>
            <input class="log-box" name="email" placeholder="Email" id="email"><br>
            <input class="log-box" name="password" type="password" placeholder="Password" id="password"><br>
            <input class="log-box" name="confirm_password" type="password" placeholder="Confirm Password" id="confirm_password"><br>
            <input class="login_button" type="submit" value="Submit" />
            <input class="login_button" type="reset" value="Reset" name="reset" />
        </form>
    </div>
</div>
        <?php
        //display page footer
        parent::displayFooter();
    }
}
