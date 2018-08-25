<?php
/*
 * Author: Melanie Turner
 * Date: 4/19/2018
 * Name: movie_index_view.class.php
 * Description: the parent class that displays a search box.
 * The javascript varaiable media specifies the media type. This variable is needed for auto suggestion.
 */

class MovieIndexView extends IndexView {

    public static function displayHeader($title) {
        parent::displayHeader($title)
        ?>
        <script>
            //the media type
            var media = "movie";
        </script>
        <!--create the search bar -->
        <div id="searchbar">
            <form method="get" action="<?= BASE_URL ?>/movie/search">
                <input type="text" name="query-terms" id="searchtextbox" placeholder="Search movies by title" autocomplete="off" onkeyup="handleKeyUp(event)">
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
