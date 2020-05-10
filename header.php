<?php
    include_once "includes/dbh.inc.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">

    <!-- FAVICONS -->
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
    <link rel="manifest" href="img/favicon/site.webmanifest">

    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <!-- JQUERY -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>

    <!-- ANIMATE CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

    <!-- AOS -->
    <link rel='stylesheet' href='https://unpkg.com/aos@next/dist/aos.css'>


    <title>Pizza You</title>
    <link rel="stylesheet" href="style.css">
</head>

<header>

    <nav id="main-nav">
        <div id="logoContainer">
            <a href="index.php">
                <div id="logo">
                    <img src="img/tri_logo.png" alt="">
                    <a id="logoText" href="index.php">Pizza You</a>
                </div>
            </a>
        </div>



        <ul id="sub-nav">

            <li id="menuBtn"><i class="fas fa-bars"></i></li>

            <div id="desktopMenu"> <?php 
            session_start();
                if(isset($_SESSION['u_name'])) { 
                    echo("<a href='profile.php?id=" . $_SESSION['customer_id'] . "'>WELCOME, " . $_SESSION['u_name'] . "</a>"); 
                    echo '<li>
                            <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
                          </li>
                          <li class="dropdown">
                            <a>Order</a>
                            <div class="dropdown-content">
                            <a href="pizzas.php">Pizza</a>
                            <a href="drinks.php">Drinks</a>
                            </div>
                            </li>


                        ';
                        if(isset($_SESSION['user_type'])){ 
                            if ($_SESSION['user_type'] == 2){
                                echo '<li><a href="data.php">Data</a></li>';
                                echo '<li><a href="manage.php">Manage</a></li>';
                            }

                        }

                        echo '
                        <div id="signin">
                            <a href="login.php">Sign In</a>
                        </div>';
                } else {
                    echo('<div id="signin">
                    <a href="login.php">Sign In</a>
                </div>');
                }
                
            ?></div>


        </ul>
    </nav>

    <nav id="mobileMenu">
        <ul>
            <li>
                <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
            </li>
            <li><a href="pizzas.php">Pizza</a></li>
            <li><a href="drinks.php">Drinks</a></li>
            <?php
                if(isset($_SESSION['user_type'])){ 
                    if ($_SESSION['user_type'] == 2){
                        echo '<li><a href="data.php">Data</a></li>';
                        echo '<li><a href="manage.php">Manage</a></li>';
                    }

                }
            ?>
            <li><a href="login.php">Sign In</a></li>

        </ul>
    </nav>

</header>

<script src='https://unpkg.com/aos@next/dist/aos.js'></script>
<script>
AOS.init({
    offset: 400, // offset (in px) from the original trigger point
    delay: 0, // values from 0 to 3000, with step 50ms
    duration: 1000 // values from 0 to 3000, with step 50ms
});
</script>
<script src="./script.js"></script>
<script>
$(window).resize(function() {
    var width = $(window).width();
    if (width > 750) {
        $("#mobileMenu").hide();
    }
})
$(document).ready(function() {


    $("#menuBtn").click(function() {
        $("#mobileMenu").slideToggle();
    })
})
</script>

<body>