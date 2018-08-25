<?php
/*
 * Author: Melanie Turner
 * Date: 4/25/2018
 * File: user_details.class.php
 * Description: displays details of a user's account info
 */
class UserDetail extends IndexView {

    public function display($user, $confirm = "") {
        //display page header
        parent::displayHeader("User Details");

        //retrieve movie details by calling get methods
        $id = $user->getId();
        $username = $user->getUsername();
        $first_name = $user->getFirstName();
        $last_name = $user->getLastName();
        $email = $user->getEmail();
        $password = $user->getPassword();?>

<div id="main-header"><h3>User Details</h3></div>
        <hr class="mid-line">
        <br/><br/>
        <table id="detail">
            <tr>
                <td style="width: 150px; height: 180px;"></td>
                <td style="width: 130px; height: 180px;">
                    <p><strong>Username:</strong></p>
                    <p><strong>First Name:</strong></p>
                    <p><strong>Last Name:</strong></p>
                    <p><strong>Email:</strong></p>
                    <p><strong>Password:</strong></p>
                    <div id="button-group">
                        <p><input class='login_button' type='button' id='edit-button' value="   Edit   "
                               onclick="window.location.href = '<?= BASE_URL ?>/user/edit/<?= $id ?>'">&nbsp;
                            </p>
                    </div>
                </td>
                <td>
                    <p><?= $username ?></p>
                    <p><?= $first_name ?></p>
                    <p><?= $last_name ?></p>
                    <p><?= $email ?></p>
                    <p class="media-description"><?= $password ?></p>
                    <div id="confirm-message"><?= $confirm ?></div>
                </td>
            </tr>
        </table>
        <br/><br/>
        <hr class="mid-line">


        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
