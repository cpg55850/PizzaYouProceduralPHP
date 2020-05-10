<?php
    include_once "dbh.inc.php";

    $MondayCount = $TuesdayCount = $WednesdayCount = $ThursdayCount = $FridayCount = $SaturdayCount = $SundayCount = $numCheese = $numPepperoni = $numMeat = $numVeggie = 0;

    // ----- Get the number of orders by pizza
    $query = "SELECT SUM(quantity) AS quantity, food_item_idfood_item AS item FROM PIZZA_YOU_food_item_ordered GROUP BY food_item_idfood_item";
    $query_results = mysqli_query($conn, $query);
    
    while($row = mysqli_fetch_assoc($query_results)){
        switch($row) {
            case $row['item'] == '1':
                $numCheese = $row['quantity'];
                break;
            case $row['item'] == '2':
                $numPepperoni = $row['quantity'];
                break;
            case $row['item'] == '5':
                $numMeat = $row['quantity'];
                break;
            case $row['item'] == '6':
                $numVeggie = $row['quantity'];
                break;
        }
    }

    // ----- Get the number of orders by weekday
    $query = "SELECT COUNT(DAYNAME(order_date)) AS count, DAYNAME(order_date) AS o_date FROM PIZZA_YOU_orders GROUP BY o_date";
    $query_results = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($query_results)){
        switch($row) {
            case $row['o_date'] == 'Monday':
                $MondayCount = $row['count'];
                break;
            case $row['o_date'] == 'Tuesday':
                $TuesdayCount = $row['count'];
                break;
            case $row['o_date'] == 'Wednesday':
                $WednesdayCount = $row['count'];
                break;
            case $row['o_date'] == 'Thursday':
                $ThursdayCount = $row['count'];
                break;
            case $row['o_date'] == 'Friday':
                $FridayCount = $row['count'];
                break;
            case $row['o_date'] == 'Saturday':
                $SaturdayCount = $row['count'];
                break;
            case $row['o_date'] == 'Sunday':
                $SundayCount = $row['count'];
                break;
        }
    }

    // ----- Get the order fulfillment time
    // Get the number of orders to loop up to
    $query = "SELECT COUNT(order_id) AS count FROM PIZZA_YOU_orders";
    $query_results = mysqli_query($conn, $query);
    if($row = mysqli_fetch_row($query_results)){
        $numOrders = $row[0];
    }

    // Get the value of each id to query and add to array
    $idArray = array();
    $query = "SELECT order_id AS id FROM PIZZA_YOU_orders";
    $query_results = mysqli_query($conn, $query);
    while($row = mysqli_fetch_row($query_results)){
        $idArray[] += $row[0];
    }

    $fulfillArr = array();
    $underOneHours = 0;
    $underTwoHours = 0;
    $underThreeHours = 0;
    $moreThanThreeHours = 0;

    for($i = $numOrders-1; $i >= 0; $i--){
        $query = "SELECT order_date FROM PIZZA_YOU_orders WHERE order_id = '$idArray[$i]'";
        $query_results = mysqli_query($conn, $query);
        if($row = mysqli_fetch_row($query_results)){
            $order_date = $row[0];
        }

        $query = "SELECT order_delivered FROM PIZZA_YOU_orders WHERE order_id = '$idArray[$i]'";
        $query_results = mysqli_query($conn, $query);
        if($row = mysqli_fetch_row($query_results)){
            $order_delivered = $row[0];
        }

        $query = "SELECT TIMESTAMPDIFF(minute, '$order_date', '$order_delivered') AS DateDiff";
        $query_results = mysqli_query($conn, $query);

        if($row = mysqli_fetch_row($query_results)){
            $timeDifference = $row[0];
        }

        if($timeDifference <= 60) {
            $underOneHours+=1;
        } else if($timeDifference <= 120){
            $underTwoHours += 1;
        } else if($timeDifference <= 180){
            $underThreeHours += 1;
        } else if($timeDifference > 180){
            $moreThanThreeHours += 1;
        }
    }
    
    $weekdayArr = array($MondayCount, $TuesdayCount, $WednesdayCount, $ThursdayCount, $FridayCount, $SaturdayCount, $SundayCount);
    $pizzaArr = array($numCheese, $numPepperoni, $numMeat, $numVeggie);
    $fulfillArr = array($underOneHours, $underTwoHours, $underThreeHours, $moreThanThreeHours);

    $returnArr = array($weekdayArr, $pizzaArr, $fulfillArr);

    $myJSON = json_encode($returnArr);

    echo $myJSON;