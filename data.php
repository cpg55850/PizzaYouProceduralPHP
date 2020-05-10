<?php
    include_once "./header.php";
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>


<div class="container">

</div>

<script>
$(document).ready(function() {
    var user_type = "<?php if(isset($_SESSION['user_type'])) echo $_SESSION['user_type']; ?>";

    if (user_type == 2) {
        $(".container").html(
            '<h1>May take a moment to load...</h1><section><h1>Orders by pizza type</h1><canvas id = "pizzaChart"></canvas></section><section><h1>Orders by day of the week</h1><canvas id = "weekChart"></canvas></section><h1>Order fulfill time</h1><canvas id = "fulfillChart"></canvas></section>'
        );

        $.getJSON("includes/data.inc.php", function(result) {

            var ctx = document.getElementById('fulfillChart').getContext('2d');
            var result = result[2];
            var myChart = new Chart(ctx, {
                type: 'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
                data: {
                    labels: ['0-1 Hours', '1-2 Hours', '2-3 Hours',
                        '3 or more hours'
                    ],
                    datasets: [{
                        label: 'Time',
                        data: [result[0], result[1], result[2], result[3]],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        });

        $.getJSON("includes/data.inc.php", function(result) {

            var ctx = document.getElementById('pizzaChart').getContext('2d');
            var result = result[1];
            var myChart = new Chart(ctx, {
                type: 'pie', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
                data: {
                    labels: ['Cheese Pizza', 'Pepperoni Pizza', 'Meat Lover\'s Pizza',
                        'Supreme Pizza'
                    ],
                    datasets: [{
                        label: '# of Orders',
                        data: [result[0], result[1], result[2], result[3]],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        });

        $.getJSON("includes/data.inc.php", function(result) {
            var ctx = document.getElementById('weekChart').getContext('2d');
            var result = result[0];
            var myChart = new Chart(ctx, {
                type: 'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
                data: {
                    labels: ['Monday', 'Tuesday', 'Wednesday',
                        'Thursday', 'Friday', 'Saturday', 'Sunday'
                    ],
                    datasets: [{
                        label: '# of Orders',
                        data: [result[0], result[1], result[2], result[3], result[
                                4],
                            result[5], result[6]
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 206, 86, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        });
    } else {
        $(".container").text("You are not authorized to access this page.");
    }



})
</script>

<?php
    include_once "./footer.php";
?>