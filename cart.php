<?php
    include_once "./header.php";
?>

<div class="container" id="output_orders">
    <?php
    include_once "includes/dbh.inc.php";

    $_SESSION['totalPrice'] = 0;

    if(isset($_SESSION['foods'])) {
        foreach($_SESSION['foods'] as $foodID => $quantity) {
            $query = "SELECT name, price FROM PIZZA_YOU_food_item WHERE idfood_item = '$foodID'";
    
            $query_results = mysqli_query($conn, $query);
    
            while($food = mysqli_fetch_assoc($query_results)){
                echo "Food: " . $food['name'] . "<br>";
                echo "Cost per item: $" . $food['price'] . "<br>";
                echo "Quantity: " . $quantity . "<br>";
                echo "Total: $" . $food['price'] * $quantity . "<br><br>";
                $_SESSION['totalPrice'] = $_SESSION['totalPrice'] + $food['price'] * $quantity;
            }    
        }
        echo("<h3>TOTAL: $" . $_SESSION['totalPrice']);

        if($_SESSION['totalPrice'] > 0) {
            echo '<input type="submit" value="Place Order" id="submitorder">';
        }
    } else {
        echo "<h2>There's nothing in your cart yet!</h2>";
        echo "<p>Click the 'Order' button at the top of the page to get started.</p>";
    }
    ?>
</div>


<script>
$("#submitorder").click(function() {
    $.get("./includes/submit_order.inc.php", function(data, status) {
        $("#output_orders").html(data);
    })

});
</script>

<?php
    include_once "./footer.php";
?>