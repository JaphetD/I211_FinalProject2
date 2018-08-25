<?php
/*
 * Author: Melanie and Corey
 * Date: 4/27/2018
 * Name: index.class.php
 * Description: This class defines the method "display" that displays the home page.
 */

class WelcomeIndex extends IndexView {

    public function display() {
        //display page header
        parent::displayHeader("BTC Home Page");
        ?>
<img src='<?= BASE_URL ?>/www/img/books-logo.jpg' style="width: 960px">
<div id="main-wrapper">
<div id="main-header">Welcome to Between the Covers!</div>
        <p> We are a thriving mom and pop business founded in the 1960's. We have always strived to bring the best in quality and price together for local Hoosiers. We have finally broken out into the internet to bring our same sense of providing the best quality and price to the world's stage. We have Movies, Books, and Sheet Music to provide to all those seeking to know what we have Between our Covers.
        </p>
        <br>
        <table style="border: none; width: 700px; margin: 5px auto">
            <tr>
                <td colspan="2" style="text-align: center"><strong>Our Sites Major features include:</strong></td>
            </tr>
            <tr>
                <td style="text-align: left">
                    <ul>
                        <li>List all media available for online distribution</li>
                        <li>Display details of specific media</li>
                        <li>We update our available media daily</li>
                        <li>Actively search for new media</li>
                    </ul>
                </td>
                <td style="text-align: left">
                    <ul>
                        <li>Search for media</li>
                        <li>Autosuggestion</li>
                        <li>Filter media</li>
                        <li>Sort media</li>
                        <!--<li>Pagination</li>-->
                    </ul></td>
            </tr>
        </table>
</div>
        <br>
<!--        <div id="main-header"></div>
    <hr class="mid-line">-->
    <br/><br/>
    <div class="content_wraper">
        <div class="admin-add-1">
            <div class="movie-add-img">
                <a name="newmovie" href="<?= BASE_URL ?>/movie/index">
                    <h1>Movies</h1>
                </a>
        </div>
            <div class="book-add-img">
            <a name="newbook" href="<?= BASE_URL ?>/book/index">
                <h1>Books</h1>
            </a>
        </div>
            <div class="music-add-img">
            <a name="newmusic" href="<?= BASE_URL ?>/music/index">
                <h1>Music</h1>
            </a>
        </div>
        </div>
    </div>

        <?php
        //display page footer
        parent::displayFooter();
    }

}
