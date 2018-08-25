<?php
/*
 * Authors: Melanie, Japhet, Matt
 * Date: 4/26/2018
 * Name: index_view.class.php
 * Description: the parent class for all view classes. The two functions display page header and footer.
 */

class IndexView {

    //this method displays the page header
    static public function displayHeader($page_title) {
            //variables for a user's login,name,and role
                
        if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                
                $count=0;
                $lastname = '';
                $firstname = '';
                $role = 0;
                
                //retrieve cart content
                if (isset($_SESSION['cart'])) {
                    $cart = $_SESSION['cart'];
                    
                    if ($cart) {
                     $count=array_sum($cart);
                    }
                }
                
                //set shopping cart image
                //$shoppingcart_img = (!$count) ? "shoppingcart_empty.gif" : "shoppingcart_full.gif";
                
                //if the user has logged in, retrieve login,name, and role.
                if (isset($_SESSION['lastname']) && isset($_SESSION['firstname']) &&
                    isset($_SESSION['role']) && isset($_SESSION['user_id']))     {
                    
                    $lastname = $_SESSION['lastname'];
                    $firstname = $_SESSION['firstname'];
                    $role = $_SESSION['role'];
                    $user_id = $_SESSION['user_id'];
                }
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <title> <?php echo $page_title ?> </title>
                <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
                <link rel='shortcut icon' href='<?= BASE_URL ?>/www/img/favicon.ico' type='image/x-icon' />
                <link type='text/css' rel='stylesheet' href='<?= BASE_URL ?>/www/css/app_style.css' />
                <link type='text/css' rel='stylesheet' href='<?= BASE_URL ?>/www/css/fontawesome-all.min.css'/>
                <script>
                    //create the JavaScript variable for the base url
                    var base_url = "<?= BASE_URL ?>";
                </script>
            </head>
            <body>
                <div id="top"></div>
                <div id='wrapper'>
                    <div id="banner">
                        <a href="<?= BASE_URL ?>/index.php" style="text-decoration: none" title="Between the Covers">
                            <div id="left">
                                <img src='<?= BASE_URL ?>/www/img/new-logov3.png' style="width: 110px; border: none" />
                                <span style='color: purple; font-size: 26pt; font-weight: bold; vertical-align: 80%'>
                                    Between the Covers
                                </span>
                                <div style='color: #000; font-size: 14pt; font-weight: bold'></div>
                            </div>
                        </a>
                        <div id="right">
                            <div class="header-nav-fix">
                                <?php if (isset($_SESSION['role']) && isset($_SESSION['user_id'])){
                                    echo "<a href='" . BASE_URL . "/user/detail/" . $user_id . "'>" .
                                        "<i class='fas fa-user-circle fa-lg' id='icon-nav' ></i>" .
                                    "</a>"; 
                                }
                                if (isset($_SESSION['role']) && $_SESSION['role'] == 2){
                                    echo "<a style='color: purple' href='" . BASE_URL . "/user/add'>" .
                                        "<i class='fas fa-plus-square fa-lg' id='icon-nav'></i>" . 
                                    "</a>"; 
                                } ?>
                                <a style="color: purple" href="<?= BASE_URL ?>/movie/index">
                                    <i class="fas fa-film fa-lg" id='icon-nav'></i>
                                </a>
                                <a style="color: purple" href="<?= BASE_URL ?>/book/index">
                                    <i class="fas fa-book fa-lg" id='icon-nav'></i>
                                </a>
                                <a style="color: purple" href="<?= BASE_URL ?>/music/index">
                                    <i class="fas fa-music fa-lg" id='icon-nav'></i>
                                </a>
                                <?php if (!isset($_SESSION['role'])){
                                    echo "<a style='color: purple' href='" . BASE_URL . "/user/login'>" .
                                        "<i class='fas fa-sign-in-alt fa-lg' id='icon-nav'></i>" . 
                                    "</a><br>" .
                                    "<p id='guestlogin' >Hello, Guest!"; 
                                } elseif (isset($_SESSION['role'])){
                                    echo "<a style='color: purple' href='" . BASE_URL . "/user/logout'>" .
                                        "<i class='fas fa-sign-out-alt fa-lg' id='icon-nav'></i>" . 
                                    "</a><br>" .
                                    "<p id='userlogin' >Hello, " . $_SESSION['firstname'] . " " . $_SESSION['lastname'] . "</p>"; 
                                } ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }

                //end of displayHeader function
                //this method displays the page footer
                public static function displayFooter() {
                    ?>
                    <br><br><br>
                    <div id="push"></div>
                </div>
                <div id="footer"><br> &copy 2018 Team Jörmungandr. All Rights Reserved. </div>
                <script type="text/javascript" src="<?= BASE_URL ?>/www/js/ajax_autosuggestion.js"></script>
            </body>
        </html>
        <?php
    }

//end of displayFooter function
}
