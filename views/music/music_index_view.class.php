<?php
/*
 * Author: Enrico Banks
 * Date: 4/26/2018
 * Name: music_index_view.class.php
 * Description: the parent class that displays a search box.
 * The javascript varaiable media specifies the media type. This variable is needed for auto suggestion.
 */

class MusicIndexView extends IndexView {

    public static function displayHeader($title) {
        parent::displayHeader($title)
        ?>
        <script>
            //the media type
            var media = "music";
        </script>
        <!--create the search bar -->
        <div id="searchbar">
            <form method="get" action="<?= BASE_URL ?>/music/search">
                <input type="text" name="query-terms" id="searchtextbox" placeholder="Search music by title" autocomplete="off" onkeyup="handleKeyUp(event)">
                <input type="submit" value="Go" />
            </form>
            <div id="suggestionDiv"></div>
        </div>
        <?php
    }

    public static function displayFooter() {
        parent::displayFooter();
    }

}
