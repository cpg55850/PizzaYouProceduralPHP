<?php 
    include_once "dbh.inc.php";
    session_start();

    $orderArray = array();
    
    $query = "SELECT * FROM PIZZA_YOU_orders";
    $query_results = mysqli_query($conn, $query);

    while($row = mysqli_fetch_row($query_results)) {
        $orderArray[] = $row;
    }

    $myJSON = json_encode($orderArray);

    echo($myJSON);