<?php
    include_once "dbh.inc.php";
    session_start();

    $totalCosts = $_SESSION['totalPrice'];
    $customer_id = $_SESSION['customer_id'];

    // Find out how many orders there are
    $query = "SELECT COUNT(order_id) FROM PIZZA_YOU_orders WHERE total_price >= 0";
    $query_results = mysqli_query($conn, $query);
    if($row = mysqli_fetch_row($query_results)) {
        $num_orders = $row[0];
    }

    // Calculate waiting time
    $waiting_time = $num_orders * 2 + 2;

    // Create new order
    $query = "INSERT INTO PIZZA_YOU_orders VALUES (NULL, NOW(), NULL, NULL, $totalCosts, $customer_id)";
    $query_results = mysqli_query($conn, $query);

    echo "<h2>Thank you for your order!</h2><br>";
    echo "New order has id: " . mysqli_insert_id($conn) . "<br>";
    $insertId = mysqli_insert_id($conn);
    echo "Your wait time: " . $waiting_time . " minutes.";

    // Create order details
    foreach($_SESSION['foods'] as $foodID => $quantity) {
        $query = "INSERT INTO PIZZA_YOU_food_item_ordered VALUES ('$insertId', '$customer_id', '$foodID', '$quantity')";
        $query_results = mysqli_query($conn, $query);
    }

    unset($_SESSION['foods']);