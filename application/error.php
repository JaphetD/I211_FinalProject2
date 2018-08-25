<?php
/**
 * Author: Melanie Turner
 * Date: 4/17/2018
 * Name: error.php
 * Description: displays an error message, received from other files to display here
 */

$page_title = "Error";
//display header
IndexView::displayHeader($page_title);

?>
<div id = "main-header">Error</div>
<hr>
<table style = "width: 100%; border: none">
    <tr>
        <td style = "vertical-align: middle; text-align: center; width:100px">
            <img src = '<?= BASE_URL ?>/www/img/error.jpg' style = "width: 80px; border: none"/>
        </td>
        <td style = "text-align: left; vertical-align: top;">
            <h3> Sorry, but an error has occurred.</h3>
            <div style = "color: red">
                <?= urldecode($message)
                ?>
            </div>
            <br>
        </td>
    </tr>
</table>
<br><br><br><br><hr>
<a style="color: purple; margin-top: 5px" href="<?= BASE_URL ?>/index.php"><i class="fas fa-arrow-circle-left"> Back to Home </i></a>

<?php
//display footer
IndexView::displayFooter();
