<?php
    include_once "dbh.inc.php";
    session_start();

    $id = $_GET['id'];
    $date_cooked = $_GET['date_cooked'];
    $time_cooked = $_GET['time_cooked'];
    $date_delivered = $_GET['date_delivered'];
    $time_delivered = $_GET['time_delivered'];
    $order_cooked = $date_cooked . " " . $time_cooked;
    $order_delivered = $date_delivered . " " . $time_delivered;

    echo("UPDATE PIZZA_YOU_orders SET order_cooked = '$order_cooked' WHERE order_id = '$id'");

    echo("UPDATE PIZZA_YOU_orders SET order_delivered = '$order_delivered' WHERE order_id = '$id'");

    if($order_cooked != " "){
        $query = "UPDATE PIZZA_YOU_orders SET order_cooked = '$order_cooked' WHERE order_id = '$id'";
        $query_results = mysqli_query($conn, $query);
    
        if($query_results) {
            echo("Done!");
        }
    }

    if($order_delivered != " ") {
        $query = "UPDATE PIZZA_YOU_orders SET order_delivered = '$order_delivered' WHERE order_id = '$id'";
        $query_results = mysqli_query($conn, $query);
    
        if($query_results) {
            echo("Done!");
        }
    }