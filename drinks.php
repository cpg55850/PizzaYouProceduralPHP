<?php
    include_once "./header.php";
?>

<div class="container">
    <h1 style="text-align: center">Order Drink</h1>
    <div id="order-container">
        <?php
        $query = "SELECT name, idfood_item, image_url FROM PIZZA_YOU_food_item WHERE category = '2'";
        $query_results = mysqli_query($conn, $query);

        if($query_results) {
            while($row = mysqli_fetch_assoc($query_results)) {
                echo '        
                <section>
                <div class="order-box">
                    <form class="drink-form" method="get" action="./includes/order.inc.php" >';


                echo '<h2>' . $row['name'] . '</h2>';
                echo '<div id="foodimg-container"><img class="foodimg" src="img/' . $row['image_url'] . '"></div>';

                echo '<h4 class="quantity-h4">Quantity:</h4>
                <select name="quantity" class="drink-quantity-selection">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>';
                echo '<input type="hidden" name="food" value="' . $row['idfood_item'] . '">';
                echo '<input type="submit" value="Order Now" id="submitbutton">';

                echo '        </form>
                </div>
                </section>';
            }
        }
        ?>
    </div>
</div>

<?php
    include_once "./footer.php";
?>