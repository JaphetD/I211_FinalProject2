<?php
//Matthew Carter
//I211
//04-26-2018

class UserEdit extends IndexView {

    public function display($user) {
        //display page header
        parent::displayHeader("Edit User");

        //retrieve user details by calling get methods
        $id = $user->getId();
        $username = $user->getUsername();
        $first_name = $user->getFirstName();
        $last_name = $user->getLastName();
        $email = $user->getEmail();
        $password = $user->getPassword();
        ?>

        <div id="main-header">Edit User Details</div>

        <!-- display user details in a form -->
        <form class="new-media"  action='<?= BASE_URL . "/user/update/" . $id ?>' method="post" style=" margin-top: 10px; padding: 10px;">
            <input type="hidden" name="id" value="<?= $id ?>">
            <br/>
            <p>
                <input style="min-width: 90%; padding-left: 8px;" name="username" class="log-box" placeholder="Username:" type="text" size="100" value="<?= $username ?>" required autofocus></p>
            <p>
                <input style="min-width: 90%; padding-left: 8px;" name="firstname" class="log-box" placeholder="First Name:" type="text" value="<?= $first_name ?>" required=""></p>
            <p>
                <input style="min-width: 90%; padding-left: 8px;" name="lastname" class="log-box" placeholder="Last Name:" type="text" size="40" value="<?= $last_name ?>" required=""></p>
            <p>
                <input style="min-width: 90%; padding-left: 8px;" name="email" class="log-box" placeholder="Email:" type="text" size="100" required value="<?= $email ?>"></p>
            <p>
                <input style="min-width: 90%; padding-left: 8px;" name="password" class="log-box" placeholder="Password:" type="password" size="20" value="<?= $password ?>"></p>
            <div id="button-group">
                <input class="login_button" type="submit" name="action" value="Update Account">
                <input class="login_button" type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/user/detail/" . $id ?>"'>
            </div>
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
?>