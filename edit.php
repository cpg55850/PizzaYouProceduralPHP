<?php 
    include_once "./header.php";
?>

<div class="container">
    <a href="manage.php">Go Back</a>
    <h2>Editing Order: <?php echo $_GET['id'] ?></h2>

    <table>
        <thead>
            <tr>
                <th>order_id</th>
                <th>order_date</th>
                <th>order_cooked</th>
                <th>order_delivered</th>
                <th>total_price</th>
                <th>customer_id</th>
            </tr>
        </thead>
        <tbody id="manageTable"></tbody>
        </thead>

    </table>
    <button id="goButton">Go</button>
    <div id="outputDiv"></div>
</div>

<script>
$(document).ready(function() {
    var id = "<?php echo $_GET['id'] ?>";

    $.getJSON("includes/edit.inc.php", {
            id: id
        },
        function(data, error) {
            console.log(typeof(data));
            var html = "";
            html += "<tr>";
            $.each(data, function(index, value) {
                console.log(value);

                if (index == 2) {
                    html +=
                        "<td><input type='date' id='date_cooked'><input type='time' id='time_cooked'></td>";
                } else if (index == 3) {
                    html +=
                        "<td><input type='date' id='date_delivered'><input type='time' id='time_delivered'></td>";
                } else {
                    html += "<td>" + value + "</td>"
                }

            })
            html += "</tr>";
            console.log(html);
            $("#manageTable").html(html);
        })
    $("#goButton").click(function() {
        var date_cooked = $('#date_cooked').val();
        var time_cooked = $('#time_cooked').val()
        var date_delivered = $('#date_delivered').val();
        var time_delivered = $('#time_delivered').val()

        if ((date_cooked == "" && time_cooked != "") ||
            (date_cooked != "" && time_cooked == "") ||
            (date_delivered == "" && time_delivered != "") ||
            (date_delivered != "" && time_delivered == "") ||
            (date_cooked == "" && time_cooked == "" &&
                date_delivered == "" && time_delivered == "")
        ) {
            console.log("Null??");
            $('#outputDiv').html('<p>Fields are empty</p>').fadeIn().delay(1000)
                .fadeOut();

        } else {
            $.get("includes/update_item.inc.php", {
                id: "<?php echo $_GET['id'] ?>",
                date_cooked: date_cooked,
                time_cooked: time_cooked,
                date_delivered: date_delivered,
                time_delivered: time_delivered
            }, function(data, status) {
                console.log("Data: " + data + " Status: " + status);
                $('#outputDiv').html('<p>Order updated</p>').fadeIn().delay(1000)
                    .fadeOut();
            })

        }

    })
});
</script>

<?php
    include_once "./footer.php";
?>