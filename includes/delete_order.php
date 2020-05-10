<?php
    include 'dbh.inc.php';
    session_start();
    $order_id = $_GET['id'];

    $sql = "DELETE FROM PIZZA_YOU_food_item_ordered WHERE orders_order_id='$order_id'";
    $query_results = mysqli_query($conn, $sql);

    $sql = "DELETE FROM PIZZA_YOU_orders WHERE order_id='$order_id'";
    $query_results = mysqli_query($conn, $sql);

    if($query_results){
        header("Location: ../profile.php?id=" . $_SESSION['customer_id'] . "&submit=success");
    } else {
        header("Location: ../profile.php?id=" . $_SESSION['customer_id'] . "&submit=failed");
    }