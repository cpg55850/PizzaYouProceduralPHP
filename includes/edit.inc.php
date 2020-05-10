<?php
    include_once "dbh.inc.php";
    session_start();

    $id = $_REQUEST['id'];

    $orderArray = array();
    
    $query = "SELECT * FROM PIZZA_YOU_orders WHERE order_id = '$id'";
    $query_results = mysqli_query($conn, $query);

    if($row = mysqli_fetch_row($query_results)) {
        $orderArray = $row;
    }

    $myJSON = json_encode($orderArray);

    echo($myJSON);