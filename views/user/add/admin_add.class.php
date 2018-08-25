<?php

/*
 * Author: Melanie Turner
 * Date: 4/25/2018
 * File: admin_add.class.php
 * Description: sends admin user to correct product creation form
 */
class AdminAdd extends IndexView {
    
    public function display(){
        //display the page header
        parent::displayHeader("Add New Product");
        ?>
    <div id="main-header">Select Type of Product to Add:</div>
    <hr>
    <div class="content_wraper">
        <div class="admin-add-1">
            <div class="movie-add-img">
                <a name="newmovie" href="<?= BASE_URL ?>/movie/add">
                    <h1>Movies</h1>
                </a>
        </div>
            <div class="book-add-img">
            <a name="newbook" href="<?= BASE_URL ?>/book/add">
                <h1>Books</h1>
            </a>
        </div>
            <div class="music-add-img">
            <a name="newmusic" href="<?= BASE_URL ?>/music/add">
                <h1>Music</h1>
            </a>
        </div>
        </div>
    </div>
        <?php
        //display the page footer
        parent::displayFooter();
    }
}
