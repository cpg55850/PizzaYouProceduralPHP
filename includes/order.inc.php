<?php 
    include_once "dbh.inc.php";
    session_start();

    $food = $_GET['food'];
    $quantity = $_GET['quantity'];
    $customer_id = $_SESSION['customer_id'];

    if(isset($_SESSION['foods'])) { // Check if the food array exists
        if(isset($_SESSION['foods'][$food])){ // check if the food exists
            $_SESSION['foods'][$food] = $_SESSION['foods'][$food] + $quantity;
        } else {
            $_SESSION['foods'][$food] = $quantity;
        }
    } else { // if not, create the array with the foodID
        $_SESSION['foods'][$food] = $quantity;
    }


    echo("foods: ");
    foreach($_SESSION['foods'] as $x => $x_value) {
        echo "key=" . $x . ", value=" . $x_value;
    }

    header('Location: ../cart.php');