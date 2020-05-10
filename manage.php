<?php
    include_once "./header.php";
?>

<div class="container">

    <h1>Order Management</h1>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>order_id</th>
                <th>order_date</th>
                <th>order_cooked</th>
                <th>order_delivered</th>
                <th>total_price</th>
                <th>customer_id</th>
            </tr>
        </thead>
        <tbody id="manageTable"></tbody>
    </table>
    <div class="output"></div>
</div>

<script>
$(document).ready(function() {
    var user_type = "<?php if(isset($_SESSION['user_type'])) echo $_SESSION['user_type'] ?>";

    $.getJSON("includes/manage.inc.php", function(data, status) {
        var html = "";
        for (var i = 0; i < data.length; i++) {
            html += "<tr>";
            html += "<td><a href='edit.php?id=" + data[i][0] +
            "'><i class='fas fa-edit'></li></a></td>";
            for (var j = 0; j < data[i].length; j++) {
                html += ("<td>" + data[i][j] + "</td>");

            }
            html += "</tr>"
        }

        $("#manageTable").append(html);


    });
});
</script>

<?php
    include_once "./footer.php";
?>