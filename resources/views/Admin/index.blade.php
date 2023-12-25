<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel - MunchMate</title>
    <link rel="stylesheet" href="{{asset('css/adminDashboard.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
@include('navbar.AdminNav');

<body class="mt-5">
    <div class="container mt-5">
        <h1 class="welcome-text">Good Morning, <span class="text-black fw-bold">{{session()->get('username')}}</span>
        </h1>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-4 mt-3">
                <div class="text-white card bg-gradient-info" id="cards">
                    <div class="card-body totalUsers">
                        <div style="float: left; height:50;">
                            <span class="material-symbols-outlined" style="font-size: 50px; margin-top:2px;">
                                group
                            </span>
                            <!-- <i class="fa fa-user fa-5x" aria-hidden="true"></i> -->
                        </div>
                        <div class="text-value-lg" style="font-size: 20px;">
                            {{$totalUsers ?? 0}}
                        </div>
                        <h5>Total Users</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mt-3">
                <div class="text-white card bg-gradient-info" id="cards">
                    <div class="card-body totalRestaurants">
                        <div style="float: left; height:50;">
                            <span class="material-symbols-outlined" style="font-size: 50px; margin-top:2px;">
                                room_service
                            </span>
                            <!-- <i class="fa fa-user fa-5x" aria-hidden="true"></i> -->
                        </div>
                        <div class="text-value-lg" style="font-size: 20px;">
                            {{$totalRestaurant ?? 0}}
                        </div>
                        <h5>Total Restaurants</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mt-3">
                <div class="text-white card bg-gradient-info" id="cards">
                    <div class="card-body totalEarnings">
                        <div style="float: left; height:50;">
                            <span class="material-symbols-outlined" style="font-size: 50px; margin-top:2px;">
                                payments
                            </span>
                            <!-- <i class="fa fa-user fa-5x" aria-hidden="true"></i> -->
                        </div>
                        <div class="text-value-lg" style="font-size: 20px;">
                            ₹ {{$totalEarning ?? 0}}
                        </div>
                        <h5>Total Earnings</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <h2 style="text-align:center">Financial Overview</h2>
    <br><br>
    <div class="container-fluid">
        <div class="row" style="justify-content: space-between">
            <!-- Chart Container -->
            <div class="col-lg-6 col-md-6">
                <div class="chart-container">
                    <div class="card card-chart">
                        <div class="card-header card-header-warning">
                            <canvas id="myChart"></canvas>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Earning per month</h4>
                            <p class="card-category">Line chart that shows earning per month</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="chart-container">
                    <div class="card card-chart">
                        <div class="card-header card-header-warning">
                            <canvas id="yourChart"></canvas>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Earning per month</h4>
                            <p class="card-category">Line chart that shows earning per month</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   

    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctxLineChart = document.getElementById('myChart');
        var totalEarningsData = {!! json_encode($totalEarningsPerMonth) !!};
        var labels = totalEarningsData.map(entry => entry.month + '/' + entry.year);
        var data = totalEarningsData.map(entry => entry.total_earning_percentage);
        
        new Chart(ctxLineChart, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: '# of Earning per month',
                    backgroundColor: "rgba(255,99,132,0.2)",
                    borderColor: "rgba(255,99,132,1)",
                    borderWidth: 2,
                    hoverBackgroundColor: "rgba(255,99,132,0.4)",
                    data: data,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    
    <script>
        const ctxBarChart = document.getElementById('yourChart');
        var topFiveUsers = @json($topFiveUsers);
        var labelsBar = topFiveUsers.map(user => user.user_name);
        var dataBar = topFiveUsers.map(user => user.total_ordered);
    
        new Chart(ctxBarChart, {
            type: 'bar',
            data: {
                labels: labelsBar,
                datasets: [{
                    label: 'Total Ordered Amount',
                    backgroundColor: "rgba(255,99,132,0.2)",
                    borderColor: "rgba(255,99,132,1)",
                    borderWidth: 2,
                    hoverBackgroundColor: "rgba(255,99,132,0.4)",
                    data: dataBar,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    

</body>

</html>